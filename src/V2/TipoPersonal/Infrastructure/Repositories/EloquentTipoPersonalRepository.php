<?php

declare(strict_types=1);

namespace Src\V2\TipoPersonal\Infrastructure\Repositories;

use App\Models\V2\TipoPersonal as eloquent;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\TipoPersonal\Domain\Contracts\TipoPersonalRepositoryContract;
use Src\V2\TipoPersonal\Domain\TipoPersonal;
use Src\V2\TipoPersonal\Domain\TipoPersonalList;
use Src\V2\TipoPersonal\Domain\TipoPersonalShort;
use Src\V2\TipoPersonal\Domain\TipoPersonalShortList;

final class EloquentTipoPersonalRepository implements TipoPersonalRepositoryContract
{
    private eloquent $eloquent;

    public function __construct()
    {
        $this->eloquent = new eloquent;
    }


    /**
     * @param Text $nombre
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     */
    public function create(
        Id $idCliente,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquent->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El tipo de personal ya se encuentra registrado');
        }

        $this->eloquent->create([
            'nombre' => $nombre->value(),
            'id_cliente' => $idCliente->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }

    /**
     * @param Id $id
     * @param Id $idCliente
     * @param Text $nombre
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     */
    public function update(
        Id $id,
        Id $idCliente,
        Text $nombre,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {

        $count = $this->eloquent->select('id')->where('id', '<>', $id->value())->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El tipo de personal ya se encuentra registrado');
        }

        $this->eloquent->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    /**
     * @param Id $id
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioModifico
     */
    public function changeState(
        Id $id,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($id->value())->update([
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $id,
    ): TipoPersonal
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->findOrFail($id->value());
        $OModel = new TipoPersonal(
            new Id($model->id , false, 'El id no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Text($model->nombre, false, -1, ''),
            new NumericInteger($model->id_estado),
            new ValueBoolean($model->id_eliminado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));

        return $OModel;
    }


    /**
     * @param Id $idCliente
     * @return TipoPersonalList
     */
    public function collectionByCliente(Id $idCliente): TipoPersonalList
    {
        $collection = new TipoPersonalList();

        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('f_registro','desc')
            ->get();

        foreach ( $models as $model ){

            $OModel = new TipoPersonal(
                new Id($model->id , false, 'El id  no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->id_estado),
                new ValueBoolean($model->id_eliminado),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
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


    /**
     * @param Id $idCliente
     * @return array
     */
    public function listByCliente(Id $idCliente): TipoPersonalShortList
    {
        $collection = new TipoPersonalShortList();

        $models = $this->eloquent->select(
            'id',
            'id_cliente',
            'nombre',
            'id_estado',
            'id_eliminado'
        )
            ->where('id_cliente',$idCliente->value())
            ->where('id_estado', 1)
            ->get();

        foreach ( $models as $model ){

            $OModel = new TipoPersonalShort(
                new Id($model->id , false, 'El id no tiene el formato correcto'),
                new Text($model->nombre, false, -1, ''),
                new Id($model->id_cliente, true, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_estado),
            );

            $collection->add($OModel);
        }

        return $collection;
    }


}
