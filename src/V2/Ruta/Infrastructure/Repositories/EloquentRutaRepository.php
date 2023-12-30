<?php

declare(strict_types=1);

namespace Src\V2\Ruta\Infrastructure\Repositories;

use App\Models\V2\Ruta as EloquentModelRuta;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\V2\Ruta\Domain\Ruta;
use Src\V2\Ruta\Domain\RutaShort;

final class EloquentRutaRepository implements RutaRepositoryContract
{
    private EloquentModelRuta $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelRuta = new EloquentModelRuta;
    }


    /**
     * @param Id $idCliente
     * @return array
     */
    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelRuta->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'tipo:id,nombre',
            'sede:id,nombre'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('f_registro','desc')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Ruta(
                new Id($model->id , false, 'El id de la Ruta no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Ruta excede los 100 caracteres'),
                new NumericInteger($model->id_tipo->value),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
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
            $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));
//            $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    /**
     * @param Id $idCliente
     * @return array
     */
    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelRuta->select(
            'id',
            'nombre',
            'id_tipo',
            'id_sede',
            'id_estado',
            'id_eliminado'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new RutaShort(
                new Id($model->id , false, 'El id del Ruta no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Ruta excede los 100 caracteres'),
                new NumericInteger($model->id_tipo->value),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    /**
     * @param NumericInteger $idTipoRuta
     * @param Id $idCliente
     * @return array
     */
    public function listByTipo(NumericInteger $idTipoRuta, Id $idCliente): array
    {
        $models = $this->eloquentModelRuta
            ->select(
                'id',
                'nombre',
                'id_tipo',
                'id_sede',
                'id_estado',
                'id_eliminado'
            )
            ->where('id_cliente',$idCliente->value())
            ->where('id_tipo',$idTipoRuta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new RutaShort(
                new Id($model->id , false, 'El id del Ruta no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la Ruta excede los 100 caracteres'),
                new NumericInteger($model->id_tipo->value),
                new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    /**
     * @param Text $nombre
     * @param NumericInteger $idTipo
     * @param Id $idCliente
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     */
    public function create(
        Text $nombre,
        NumericInteger $idTipo,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquentModelRuta->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La ruta ya se encuentra registrada');
        }

        $this->eloquentModelRuta->create([
           'nombre' => $nombre->value(),
           'id_tipo' => $idTipo->value(),
            'id_cliente' => $idCliente->value(),
            'id_sede' => $idSede->value(),
           'id_estado' => $idEstado->value(),
           'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    /**
     * @param Id $id
     * @param Text $nombre
     * @param NumericInteger $idTipo
     * @param NumericInteger $idEstado
     * @param Id $idUsuarioRegistro
     */
    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipo,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $perfil = $this->eloquentModelRuta->findOrFail($id->value());

        $count = $this->eloquentModelRuta->select('id')->where('id', '<>', $id->value())->where('id_cliente', $perfil->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La ruta ya se encuentra registrada');
        }

        $this->eloquentModelRuta->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_tipo' => $idTipo->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelRuta->findOrFail($idRuta->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idRuta,
    ): Ruta
    {
        $model = $this->eloquentModelRuta->with('usuarioRegistro:id,nombres,apellidos', 'usuarioModifico:id,nombres,apellidos', 'tipo:id,nombre')->findOrFail($idRuta->value());
        $OModel = new Ruta(
            new Id($model->id , false, 'El id del Ruta no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre del Ruta excede los 100 caracteres'),
            new NumericInteger($model->id_tipo->value),
            new Id($model->id_sede, true, 'El id de la sede no tiene el formato correcto'),
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
        $OModel->setTipo(new Text(!is_null($model->tipo) ? $model->tipo->nombre : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ? $model->sede->nombre : null, true, -1));

        return $OModel;
    }

}
