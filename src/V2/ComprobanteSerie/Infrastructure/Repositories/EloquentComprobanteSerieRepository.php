<?php

declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Infrastructure\Repositories;

use App\Models\V2\ComprobanteSerie as eloquent;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerie;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerieShort;

final class EloquentComprobanteSerieRepository implements ComprobanteSerieRepositoryContract
{
    private eloquent $eloquent;

    public function __construct()
    {
        $this->eloquent = new eloquent;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioRegistro:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre',
            'empresa:id,nombre'
        )->where('id_cliente',$idCliente->value())
            ->orderBy('f_registro','desc')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ComprobanteSerie(
                new Id($model->id , false, 'El id no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante->value),
                new Text($model->nombre, false, -1),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_empresa, true, 'El id de la empresa no tiene el formato correcto'),
                new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value)
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setSede(new Text(!is_null($model->sede) ?  $model->sede->nombre  : null, true, -1));
            $OModel->setTipoComprobante(new Text(!is_null($model->tipoComprobante) ?  $model->tipoComprobante->nombre  : null, true, -1));
            $OModel->setEmpresa(new Text(!is_null($model->empresa) ?  $model->empresa->nombre  : null, true, -1));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquent->select(
            'id',
            'id_tipo_comprobante',
            'nombre',
            'id_sede',
            'id_estado'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new ComprobanteSerieShort(
                new Id($model->id , false, 'El id no tiene el formato correcto'),
                new NumericInteger($model->id_tipo_comprobante ),
                new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
                new Id($model->id_empresa , false, 'El id de la empresa no tiene el formato correcto'),
                new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value)
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idEmpresa,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $existe = $this->eloquent
            ->where('id_cliente' , $idCliente->value())
            ->where('id_empresa' , $idEmpresa->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value()))
            //->where('id_tipo_comprobante',$idTipoComprobante->value())
            //->where('id_sede', $idSede->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('La serie ya se encuentra registrada');
        }

        $this->eloquent->create([
            'nombre' => trim($nombre->value()),
            'id_tipo_comprobante' => $idTipoComprobante->value(),
            'id_cliente' => $idCliente->value(),
            'id_empresa' => $idEmpresa->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idEmpresa,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $existe = $this->eloquent
            ->where('id', '<>' , $id->value())
            ->where('id_cliente' , $idCliente->value())
            ->where('id_empresa' , $idEmpresa->value())
            ->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value()))
            //->where('idTipoComprobante',$idTipoComprobante->value())
            //->where('idSede', $idSede->value())
            ->count();

        if($existe > 0){
            throw new \InvalidArgumentException('La serie ya se encuentra registrada');
        }

        $this->eloquent->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'id_tipo_comprobante' => $idTipoComprobante->value(),
            'id_empresa' => $idEmpresa->value(),
            'id_sede' => $idSede->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idComprobanteSerie,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquent->findOrFail($idComprobanteSerie->value())->update([
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idComprobanteSerie,
    ): ComprobanteSerie
    {
        $model = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioRegistro:id,nombres,apellidos',
            'tipoComprobante:id,nombre',
            'sede:id,nombre'
        )->findOrFail($idComprobanteSerie->value());

        $OModel = new ComprobanteSerie(
            new Id($model->id , false, 'El id no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante->value),
            new Text($model->nombre, false, -1),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new Id($model->id_empresa, true, 'El id de la empresa no tiene el formato correcto'),
            new Id($model->id_sede, false, 'El id de la sede no tiene el formato correcto'),
            new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, true, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value),

        );

        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setSede(new Text(!is_null($model->sede) ?  $model->sede->nombre  : null, true, -1));
        $OModel->setTipoComprobante(new Text(!is_null($model->tipoComprobante) ?  $model->tipoComprobante->nombre  : null, true, -1));
        $OModel->setEmpresa(new Text(!is_null($model->empresa) ?  $model->empresa->nombre  : null, true, -1));

        return $OModel;
    }


    public function findByEmpresaTipoComprobanteSede(
        Id $idEmpresa,
        Id $idSede,
        NumericInteger $idTipoComprobante,
    ): ComprobanteSerieShort
    {

        $model = $this->eloquent->where('id_empresa', $idEmpresa->value())
                        ->where('id_sede', $idSede->value())
                        ->where('id_tipo_comprobante', $idTipoComprobante->value())
                        ->get();

        if($model->isEmpty()){
            throw new \InvalidArgumentException('No existe serie registrada');
        }

        if($model->count() > 1){
            throw new \InvalidArgumentException('Existe más de una serie registrada');
        }

        $model = $model->first();


        $OModel = new ComprobanteSerieShort(
            new Id($model->id , false, 'El id no tiene el formato correcto'),
            new NumericInteger($model->id_tipo_comprobante->value ),
            new Text($model->nombre, false, 100, 'El nombre de la destino excede los 100 caracteres'),
            new Id($model->id_empresa , false, 'El id de la empresa no tiene el formato correcto'),
            new Id($model->id_sede , false, 'El id de la sede no tiene el formato correcto'),
            new NumericInteger($model->id_estado->value)
        );

        return $OModel;
    }

}
