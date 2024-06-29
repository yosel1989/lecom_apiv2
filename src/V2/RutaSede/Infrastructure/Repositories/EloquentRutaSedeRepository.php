<?php

declare(strict_types=1);

namespace Src\V2\RutaSede\Infrastructure\Repositories;

use App\Models\V2\RutaSede as EloquentModelRutaSede;
use App\Models\V2\Sede;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\RutaSede\Domain\Contracts\RutaSedeRepositoryContract;
use Src\V2\RutaSede\Domain\RutaSede;

final class EloquentRutaSedeRepository implements RutaSedeRepositoryContract
{
    private EloquentModelRutaSede $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelRutaSede;
    }


    public function collectionByClienteRuta(Id $idCliente, Id $idRuta): array
    {
        $models = Sede::select(
                            DB::raw("(SELECT id FROM ruta_sede WHERE id_sede = sede.id LIMIT 1) as id"),
                            'id_cliente',
                            DB::raw("(SELECT id_ruta FROM ruta_sede WHERE id_sede = sede.id LIMIT 1) as id_ruta"),
                            'id_sede',
                            'nombre'
                        )->where('id_cliente', $idCliente)
                        ->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new RutaSede(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Id($model->id_cliente , false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_ruta , false, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            );

            $OModel->setSede(new Text($model->nombre, false, -1, ''));

            $collection[] = $OModel;
        }

        return $collection;
    }


    public function assign(
        Id $idCliente,
        Id $idRuta,
        array $sedes,
        Id $idUsuario
    ): void
    {
        DB::beginTransaction();
        try {

            // borrar las relaciones
            $this->eloquent->where('id_ruta', $idRuta->value())->delete();

            // registrar las nuevas relaciones
            foreach ($sedes as $idSede) {
                $this->eloquent->create([
                    'id_cliente' => $idCliente->value(),
                    'id_ruta' => $idRuta->value(),
                    'id_sede' => $idSede,
                    'id_usu_registro' => $idUsuario->value()
                ]);
            }

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            throw new \InvalidArgumentException($e->getMessage());
        }

    }



}
