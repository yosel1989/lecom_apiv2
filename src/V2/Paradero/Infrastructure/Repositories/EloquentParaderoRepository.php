<?php

declare(strict_types=1);

namespace Src\V2\Paradero\Infrastructure\Repositories;

use App\Models\V2\Paradero as EloquentModelParadero;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;
use Src\V2\Paradero\Domain\Paradero;
use Src\V2\Paradero\Domain\ParaderoShort;

final class EloquentParaderoRepository implements ParaderoRepositoryContract
{
    private EloquentModelParadero $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelParadero = new EloquentModelParadero;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelParadero->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
//            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre','ASC')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Paradero(
                new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
//                new NumericFloat($model->precioBase),
                new NumericFloat($model->latitud),
                new NumericFloat($model->longitud),
                new NumericInteger($model->id_tipo_ruta->value),
//                new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//            $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
            $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelParadero
            ->where('id_cliente',$idCliente->value())
            ->orderBy('nombre','ASC')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ParaderoShort(
                new Id($model->id , false, 'El id del destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
//                new NumericFloat($model->precioBase),
                new NumericInteger($model->id_tipo_ruta->value),
//                new Id($model->idRuta , false, 'El id de la ruta no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function listByClienteByRuta(Id $idCliente, Id $idRuta): array
    {
        $models = $this->eloquentModelParadero
            ->where('id_cliente',$idCliente->value())
//            ->where('idRuta',$idRuta->value())
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ParaderoShort(
                new Id($model->id , false, 'El id del destino no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
//                new NumericFloat($model->precioBase),
                new NumericInteger($model->id_tipo_ruta->value),
//                new Id($model->idRuta , false, 'El id de la ruta no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
//        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
//        Id $idRuta,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquentModelParadero->select('id')
            ->where('id_cliente', $idCliente->value())
            ->where('id_tipo_ruta', $idTipoRuta->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El paradero ya se encuentra registrado');
        }

        $this->eloquentModelParadero->create([
            'nombre' => $nombre->value(),
//            'precioBase' => $precioBase->value(),
            'latitud' => $latitud->value(),
            'longitud' => $longitud->value(),
            'id_tipo_ruta' => $idTipoRuta->value(),
//            'idRuta' => $idRuta->value(),
            'id_cliente' => $idCliente->value(),
            'id_estado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
//        NumericFloat $precioBase,
        NumericFloat $latitud,
        NumericFloat $longitud,
        NumericInteger $idTipoRuta,
//        Id $idRuta,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $paradero = $this->eloquentModelParadero->findOrFail($id->value());

        $count = $this->eloquentModelParadero->select('id')
            ->where('id', '<>', $id->value())
            ->where('id_cliente', $paradero->id_cliente)
            ->where('id_tipo_ruta', $idTipoRuta->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El paradero ya se encuentra registrado');
        }

        $paradero->update([
            'nombre' => $nombre->value(),
//            'precioBase' => $precioBase->value(),
            'latitud' => $latitud->value(),
            'longitud' => $longitud->value(),
            'id_tipo_ruta' => $idTipoRuta->value(),
//            'idRuta' => $idRuta->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idParadero,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelParadero->findOrFail($idParadero->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idParadero,
    ): Paradero
    {
        $model = $this->eloquentModelParadero->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
//            'ruta:id,nombre',
            'tipoRuta:id,nombre',
        )->findOrFail($idParadero->value());
        $OModel = new Paradero(
            new Id($model->id , false, 'El id de la destino no tiene el formato correcto'),
            new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
//            new NumericFloat($model->precioBase),
            new NumericFloat($model->latitud),
            new NumericFloat($model->longitud),
            new NumericInteger($model->id_tipo_ruta->value),
//            new Id($model->idRuta, false, 'El id de la ruta no tiene el formato correcto'),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),
            new NumericInteger($model->id_eliminado->value),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
//        $OModel->setRuta(new Text(!is_null($model->ruta) ?  $model->ruta->nombre  : null, true, -1));
        $OModel->setTipoRuta(new Text(!is_null($model->tipoRuta) ?  $model->tipoRuta->nombre  : null, true, -1));


        return $OModel;
    }

}
