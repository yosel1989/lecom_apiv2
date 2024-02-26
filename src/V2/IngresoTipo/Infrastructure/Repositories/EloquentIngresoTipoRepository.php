<?php

declare(strict_types=1);

namespace Src\V2\IngresoTipo\Infrastructure\Repositories;

use App\Models\V2\IngresoTipo as EloquentModelIngresoTipo;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\IngresoTipo\Domain\Contracts\IngresoTipoRepositoryContract;
use Src\V2\IngresoTipo\Domain\IngresoTipo;
use Src\V2\IngresoTipo\Domain\IngresoTipoList;
use Src\V2\IngresoTipo\Domain\IngresoTipoShort;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;

final class EloquentIngresoTipoRepository implements IngresoTipoRepositoryContract
{
    private EloquentModelIngresoTipo $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelIngresoTipo;
    }


    public function collectionByCliente(Id $idCliente): IngresoTipoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'categoria:id,nombre',
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')
            ->get();

        $collection = new IngresoTipoList();

        foreach ( $models as $model ){

            $OModel = new IngresoTipo(
                new Id($model->id , false, 'El id del tipo de ingreso no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del tipo de ingreso excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_ingreso_categoria, false, 'El id de la categoria no tiene el formato correcto'),
                new NumericFloat($model->precio_base),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setCategoria(new Text($model->categoria->nombre, false, -1, ''));

            $collection->add($OModel);
        }

        return $collection;
    }


    public function listByCliente(Id $idCliente): IngresoTipoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'id_ingreso_categoria',
            'precio_base',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')->get();

        $collection = new IngresoTipoShortList();

        foreach ( $models as $model ){

            $OModel = new IngresoTipoShort(
                new Id($model->id , false, 'El id del tipo de ingreso no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del tipo de ingreso excede los 100 caracteres'),
                new Id($model->id_ingreso_categoria, false, 'El id de la categoria no tiene el formato correcto'),
                new NumericFloat($model->precio_base),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function listByClienteByCategoria(Id $idCliente, Id $idCategoria): IngresoTipoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'id_ingreso_categoria',
            'precio_base',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())
            ->where('id_ingreso_categoria',$idCategoria->value())
            ->where('id_estado',1)
            ->where('id_eliminado',0)
            ->orderBy('nombre', 'asc')->get();

        $collection = new IngresoTipoShortList();

        foreach ( $models as $model ){

            $OModel = new IngresoTipoShort(
                new Id($model->id , false, 'El id del tipo de ingreso no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del tipo de ingreso excede los 100 caracteres'),
                new Id($model->id_ingreso_categoria, false, 'El id de la categoria no tiene el formato correcto'),
                new NumericFloat($model->precio_base),
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
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquent->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El tipo de egreso ya se encuentra registrada');
        }

        $this->eloquent->create([
            'nombre' => $nombre->value(),
            'id_cliente' => $idCliente->value(),
            'id_ingreso_categoria' => $idCategoria->value(),
            'precio_base' => $precioBase->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Id $idCategoria,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $IngresoTipo = $this->eloquent->findOrFail($id->value());

        $count = $this->eloquent->select('id')->where('id', '<>', $id->value())->where('id_cliente', $IngresoTipo->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El tipo de egreso ya se encuentra registrada');
        }

        $this->eloquent->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_ingreso_categoria' => $idCategoria->value(),
            'precio_base' => $precioBase->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idIngresoTipo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($idIngresoTipo->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idIngresoTipo,
    ): IngresoTipo
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idIngresoTipo->value());
        $OModel = new IngresoTipo(
            new Id($model->id , false, 'El id del tipo de ingreso no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del tipo de ingreso excede los 100 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_ingreso_categoria, false, 'El id de la categoria no tiene el formato correcto'),
            new NumericFloat($model->precio_base),
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
