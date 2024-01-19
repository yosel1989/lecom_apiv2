<?php

declare(strict_types=1);

namespace Src\V2\EgresoCategoria\Infrastructure\Repositories;

use App\Models\V2\EgresoCategoria as EloquentModelEgresoCategoria;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoCategoria\Domain\Contracts\EgresoCategoriaRepositoryContract;
use Src\V2\EgresoCategoria\Domain\EgresoCategoria;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaList;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaShort;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaShortList;

final class EloquentEgresoCategoriaRepository implements EgresoCategoriaRepositoryContract
{
    private EloquentModelEgresoCategoria $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgresoCategoria;
    }


    public function collectionByCliente(Id $idCliente): EgresoCategoriaList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')
            ->get();

        $collection = new EgresoCategoriaList();

        foreach ( $models as $model ){

            $OModel = new EgresoCategoria(
                new Id($model->id , false, 'El id de la EgresoCategoria no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la EgresoCategoria excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

            $collection->add($OModel);
        }

        return $collection;
    }


    public function listByCliente(Id $idCliente): EgresoCategoriaShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())->orderBy('nombre', 'asc')->get();

        $collection = new EgresoCategoriaShortList();

        foreach ( $models as $model ){

            $OModel = new EgresoCategoriaShort(
                new Id($model->id , false, 'El id del EgresoCategoria no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la EgresoCategoria excede los 100 caracteres'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function create(
        Text $nombre,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquent->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La categoria ya se encuentra registrada');
        }

        $this->eloquent->create([
            'nombre' => $nombre->value(),
            'id_cliente' => $idCliente->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $EgresoCategoria = $this->eloquent->findOrFail($id->value());

        $count = $this->eloquent->select('id')->where('id', '<>', $id->value())->where('id_cliente', $EgresoCategoria->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La categoria ya se encuentra registrada');
        }

        $this->eloquent->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idEgresoCategoria,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($idEgresoCategoria->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idEgresoCategoria,
    ): EgresoCategoria
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->findOrFail($idEgresoCategoria->value());
        $OModel = new EgresoCategoria(
            new Id($model->id , false, 'El id del EgresoCategoria no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del EgresoCategoria excede los 100 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));


        return $OModel;
    }

}
