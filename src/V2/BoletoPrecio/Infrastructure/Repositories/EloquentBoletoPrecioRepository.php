<?php

declare(strict_types=1);

namespace Src\V2\BoletoPrecio\Infrastructure\Repositories;

use App\Models\V2\BoletoPrecio as EloquentModelBoletoPrecio;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoPrecio\Domain\Contracts\BoletoPrecioRepositoryContract;
use Src\V2\BoletoPrecio\Domain\BoletoPrecio;
use Src\V2\BoletoPrecio\Domain\BoletoPrecioShort;

final class EloquentBoletoPrecioRepository implements BoletoPrecioRepositoryContract
{
    private EloquentModelBoletoPrecio $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelBoletoPrecio = new EloquentModelBoletoPrecio;
    }


    public function collectionByCliente(Id $idCliente, Id $idRuta): array
    {
        $models = $this->eloquentModelBoletoPrecio->with(
            'paraderoOrigen:id,nombre',
            'paraderoDestino:id,nombre',
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->where('id_cliente',$idCliente->value())
        ->where('id_ruta',$idRuta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoPrecio(
                new Id($model->id, false, 'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_ruta->value, false),
                new Id($model->id_ruta, false, 'El id de la ruta no tiene el formato correcto'),

                new Id($model->id_paradero_origen, false, 'El id del punto de origen no tiene el formato correcto'),
                new Id($model->id_paradero_destino, false, 'El id del punto de destino no tiene el formato correcto'),
                new NumericFloat($model->precio_base, false),

                new NumericInteger($model->id_estado->value, false),
                new NumericInteger($model->id_eliminado->value, false),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false),
                new DateTimeFormat($model->f_modifico, true)
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setParaderoOrigen(new Text(!is_null($model->paraderoOrigen) ?  $model->paraderoOrigen->nombre  : null, true, -1));
            $OModel->setParaderoDestino(new Text(!is_null($model->paraderoDestino) ?  $model->paraderoDestino->nombre  : null, true, -1));
            $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
            $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelBoletoPrecio->with(
            'paraderoOrigen:id,nombre',
            'paraderoDestino:id,nombre'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoPrecioShort(
                new Id($model->id, false, 'El id no tiene el formato correcto'),

                new Id($model->id_paradero_origen, false, 'El id del punto de origen no tiene el formato correcto'),
                new Id($model->id_paradero_destino, false, 'El id del punto de destino no tiene el formato correcto'),
                new NumericFloat($model->precio_base, false),

                new NumericInteger($model->id_estado->value, false),
                new NumericInteger($model->id_eliminado->value, false)
            );

            $OModel->setParaderoOrigen(new Text(!is_null($model->paraderoOrigen) ? $model->paraderoOrigen->nombre : null, true, -1));
            $OModel->setParaderoDestino(new Text(!is_null($model->paraderoDestino) ? $model->paraderoDestino->nombre : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function listByClienteByRuta(Id $idCliente, Id $idRuta): array
    {
        $models = $this->eloquentModelBoletoPrecio->with(
                'paraderoOrigen:id,nombre',
                'paraderoDestino:id,nombre'
            )
            ->where('id_cliente',$idCliente->value())
            ->where('id_ruta',$idRuta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new BoletoPrecioShort(
                new Id($model->id, false, 'El id no tiene el formato correcto'),

                new Id($model->id_paradero_origen, false, 'El id del punto de origen no tiene el formato correcto'),
                new Id($model->id_paradero_destino, false, 'El id del punto de destino no tiene el formato correcto'),
                new NumericFloat($model->precio_base, false),

                new NumericInteger($model->id_estado->value, false),
                new NumericInteger($model->id_eliminado->value, false)
            );

            $OModel->setParaderoOrigen(new Text(!is_null($model->paraderoOrigen) ? $model->paraderoOrigen->nombre : null, true, -1));
            $OModel->setParaderoDestino(new Text(!is_null($model->paraderoDestino) ? $model->paraderoDestino->nombre : null, true, -1));

            $arr[] = $OModel;
        }

        return $arr;
    }

    public function create(
        Id $idCliente,
        NumericInteger $idTipoRuta,
        Id $idRuta,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {

        $existe = $this->eloquentModelBoletoPrecio
            ->select('id')
            ->where('id_cliente', $idCliente->value())
            ->where('id_ruta', $idRuta->value())
            ->where('id_paradero_origen', $idParaderoOrigen->value())
            ->where('id_paradero_destino', $idParaderoDestino->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El viaje ya se encuentra registrado');
        }

        $this->eloquentModelBoletoPrecio->create([
            'id_cliente' => $idCliente->value(),
            'id_tipo_ruta' => $idTipoRuta->value(),
            'id_ruta' => $idRuta->value(),
            'id_paradero_origen' => $idParaderoOrigen->value(),
            'id_paradero_destino' => $idParaderoDestino->value(),
            'precio_base' => $precioBase->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Id $idParaderoOrigen,
        Id $idParaderoDestino,
        NumericFloat $precioBase,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $model = $this->eloquentModelBoletoPrecio->findOrFail($id->value());

        $existe = $this->eloquentModelBoletoPrecio->select('id')
            ->where('id', '<>', $id->value())
            ->where('id_cliente', $model->id_cliente)
            ->where('id_ruta', $model->id_ruta)
            ->where('id_paradero_origen', $idParaderoOrigen->value())
            ->where('id_paradero_destino', $idParaderoDestino->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('El viaje ya se encuentra registrado');
        }

        $model->update([
            'id_paradero_origen' => $idParaderoOrigen->value(),
            'id_paradero_destino' => $idParaderoDestino->value(),
            'precio_base' => $precioBase->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idBoletoPrecio,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelBoletoPrecio->findOrFail($idBoletoPrecio->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idBoletoPrecio,
    ): BoletoPrecio
    {
        $model = $this->eloquentModelBoletoPrecio->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->findOrFail($idBoletoPrecio->value());
        $OModel = new BoletoPrecio(
            new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
            new NumericFloat($model->precioBase),
            new NumericFloat($model->latitud),
            new NumericFloat($model->longitud),
            new NumericInteger($model->idTipoRuta->value),
            new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),
            new NumericInteger($model->idEliminado->value),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
        $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));


        return $OModel;
    }

}
