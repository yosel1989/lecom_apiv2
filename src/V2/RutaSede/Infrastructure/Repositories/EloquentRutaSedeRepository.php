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
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\RutaSede\Domain\Contracts\RutaSedeRepositoryContract;
use Src\V2\RutaSede\Domain\RutaSede;
use Src\V2\Sede\Domain\SedeShort;

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
                            'id',
                            'id_cliente',
                            DB::raw(" CASE WHEN (SELECT COUNT(*) FROM ruta_sede WHERE id_sede = sede.id and id_ruta = '{$idRuta->value()}') > 0 THEN true ELSE false END as selected"),
                            'codigo',
                            'nombre',
                            'id_estado',
                            'id_eliminado'
                        )->where('id_cliente', $idCliente->value())
                        ->where('id_estado', 1)
                        ->get();

        $collection = array();

        foreach ( $models as $model ){

            $OModel = new SedeShort(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre , false, -1, ''),
                new Text($model->codigo , false, -1, ''),
                new NumericInteger($model->id_estado->value ),
                new NumericInteger($model->id_eliminado->value ),
            );

            $OModel->setSelected(new ValueBoolean($model->selected));

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
