<?php

declare(strict_types=1);

namespace Src\V2\EgresoTipo\Infrastructure\Repositories;

use App\Models\V2\EgresoTipo as EloquentModelEgresoTipo;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoTipo\Domain\Contracts\EgresoTipoRepositoryContract;
use Src\V2\EgresoTipo\Domain\EgresoTipo;
use Src\V2\EgresoTipo\Domain\EgresoTipoList;
use Src\V2\EgresoTipo\Domain\EgresoTipoShort;
use Src\V2\EgresoTipo\Domain\EgresoTipoShortList;

final class EloquentEgresoTipoRepository implements EgresoTipoRepositoryContract
{
    private EloquentModelEgresoTipo $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgresoTipo;
    }


    public function collectionByCliente(Id $idCliente): EgresoTipoList
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'categoria:id,nombre',
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')
            ->get();

        $collection = new EgresoTipoList();

        foreach ( $models as $model ){

            $OModel = new EgresoTipo(
                new Id($model->id , false, 'El id de la EgresoTipo no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la EgresoTipo excede los 100 caracteres'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_categoria_egreso, false, 'El id de la categoria no tiene el formato correcto'),
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


    public function listByCliente(Id $idCliente): EgresoTipoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'id_categoria_egreso',
            'precio_base',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')->get();

        $collection = new EgresoTipoShortList();

        foreach ( $models as $model ){

            $OModel = new EgresoTipoShort(
                new Id($model->id , false, 'El id del EgresoTipo no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la EgresoTipo excede los 100 caracteres'),
                new Id($model->id_categoria_egreso, false, 'El id de la categoria no tiene el formato correcto'),
                new NumericFloat($model->precio_base),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $collection->add($OModel);
        }

        return $collection;
    }

    public function listByClienteByCategoria(Id $idCliente, Id $idCategoria): EgresoTipoShortList
    {
        $models = $this->eloquent->select(
            'id',
            'nombre',
            'id_categoria_egreso',
            'precio_base',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())
            ->where('id_categoria_egreso',$idCategoria->value())
            ->where('id_estado',1)
            ->where('id_eliminado',0)
            ->orderBy('nombre', 'asc')->get();

        $collection = new EgresoTipoShortList();

        foreach ( $models as $model ){

            $OModel = new EgresoTipoShort(
                new Id($model->id , false, 'El id del EgresoTipo no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la EgresoTipo excede los 100 caracteres'),
                new Id($model->id_categoria_egreso, false, 'El id de la categoria no tiene el formato correcto'),
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
            'id_categoria_egreso' => $idCategoria->value(),
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
        $EgresoTipo = $this->eloquent->findOrFail($id->value());

        $count = $this->eloquent->select('id')->where('id', '<>', $id->value())->where('id_cliente', $EgresoTipo->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El tipo de egreso ya se encuentra registrada');
        }

        $this->eloquent->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_categoria_egreso' => $idCategoria->value(),
            'precio_base' => $precioBase->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idEgresoTipo,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($idEgresoTipo->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idEgresoTipo,
    ): EgresoTipo
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
        )->findOrFail($idEgresoTipo->value());
        $OModel = new EgresoTipo(
            new Id($model->id , false, 'El id del EgresoTipo no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del EgresoTipo excede los 100 caracteres'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_categoria_egreso, false, 'El id de la categoria no tiene el formato correcto'),
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
