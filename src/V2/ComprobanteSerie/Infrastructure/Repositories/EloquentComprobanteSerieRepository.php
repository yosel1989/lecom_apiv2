<?php

declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Infrastructure\Repositories;

use App\Models\V2\ComprobanteSerie as EloquentModelComprobanteSerie;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerie;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerieShort;

final class EloquentComprobanteSerieRepository implements ComprobanteSerieRepositoryContract
{
    private EloquentModelComprobanteSerie $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelComprobanteSerie = new EloquentModelComprobanteSerie;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelComprobanteSerie->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioRegistro:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre'
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ComprobanteSerie(
                new Id($model->id , false, 'El id no tiene el formato correcto'),
                new NumericInteger($model->idTipoComprobante->value),
                new Text($model->nombre, false, -1),
                new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->idSede, false, 'El id de la sede no tiene el formato correcto'),
                new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value)
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ?  $model->sede->nombre  : null, true, -1));
            $OModel->setTipoComprobante(new Text(!is_null($model->tipoComprobante) ?  $model->tipoComprobante->nombre  : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelComprobanteSerie->select(
            'id',
            'idTipoComprobante',
            'nombre',
            'idSede',
            'idEstado'
        )->where('idCliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ComprobanteSerieShort(
                new Id($model->id , false, 'El id no tiene el formato correcto'),
                new NumericInteger($model->idTipoComprobante ),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new Id($model->idSede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->idEstado->value)
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $existe = $this->eloquentModelComprobanteSerie
            ->where('idCliente' , $idCliente->value())
            ->where('nombre', trim($nombre->value()))
            ->where('idTipoComprobante',$idTipoComprobante->value())
            ->where('idSede', $idSede->value())
            ->get()->count();

        if($existe){
            throw new \InvalidArgumentException('La serie ya se encuentra registrada');
        }

        $this->eloquentModelComprobanteSerie->create([
            'nombre' => trim($nombre->value()),
            'idTipoComprobante' => $idTipoComprobante->value(),
            'idCliente' => $idCliente->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioRegistro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $existe = $this->eloquentModelComprobanteSerie
            ->where('idCliente' , $idCliente->value())
            ->where('nombre', trim($nombre->value()))
            ->where('idTipoComprobante',$idTipoComprobante->value())
            ->where('idSede', $idSede->value())
            ->where('id', '!=', $id->value())
            ->get()->count();

        if($existe){
            throw new \InvalidArgumentException('La serie ya se encuentra registrada');
        }

        $this->eloquentModelComprobanteSerie->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'idTipoComprobante' => $idTipoComprobante->value(),
            'idSede' => $idSede->value(),
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idComprobanteSerie,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelComprobanteSerie->findOrFail($idComprobanteSerie->value())->update([
            'idEstado' => $idEstado->value(),
            'idUsuarioModifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idComprobanteSerie,
    ): ComprobanteSerie
    {
        $model = $this->eloquentModelComprobanteSerie->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioRegistro:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre'
        )->findOrFail($idComprobanteSerie->value());

        $OModel = new ComprobanteSerie(
            new Id($model->id , false, 'El id no tiene el formato correcto'),
            new NumericInteger($model->idTipoComprobante->value),
            new Text($model->nombre, false, -1),
            new Id($model->idCliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->idSede, false, 'El id de la sede no tiene el formato correcto'),
            new Id($model->idUsuarioRegistro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->idUsuarioModifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->fechaRegistro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->fechaModifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            new NumericInteger($model->idEstado->value),

        );

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ?  $model->sede->nombre  : null, true, -1));
        $OModel->setTipoComprobante(new Text(!is_null($model->tipoComprobante) ?  $model->tipoComprobante->nombre  : null, true, -1));

        return $OModel;
    }

}
