<?php

declare(strict_types=1);

namespace Src\V2\Empresa\Infrastructure\Repositories;

use App\Models\V2\Empresa as EloquentModelEmpresa;
use Illuminate\Support\Facades\DB;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Empresa\Domain\Contracts\EmpresaRepositoryContract;
use Src\V2\Empresa\Domain\Empresa;
use Src\V2\Empresa\Domain\EmpresaShort;

final class EloquentEmpresaRepository implements EmpresaRepositoryContract
{
    private EloquentModelEmpresa $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelEmpresa = new EloquentModelEmpresa;
    }


    public function collectionByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelEmpresa->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos',
            'ubigeo',
        )->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')
            ->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Empresa(
                new Id($model->id , false, 'El id de la empresa no tiene el formato correcto'),
                new Text($model->nombre, false, -1, ''),
                new Text($model->ruc, false, -1, ''),
                new Text($model->direccion, false, 150, 'La direccion de la Empresa excede los 150 caracteres'),
                new Text($model->id_ubigeo, true, -1, ''),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new ValueBoolean($model->predeterminado),
                new NumericInteger($model->id_estado),
                new NumericInteger($model->id_eliminado),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );

            $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, false, -1));
            $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setDepartamento(new Text(!is_null($model->ubigeo) ? $model->ubigeo->departamento : null, true, -1 , ''));
            $OModel->setProvincia(new Text(!is_null($model->ubigeo) ? $model->ubigeo->provincia : null, true, -1 , ''));
            $OModel->setDistrito(new Text(!is_null($model->ubigeo) ? $model->ubigeo->distrito : null, true, -1 , ''));

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function listByCliente(Id $idCliente): array
    {
        $models = $this->eloquentModelEmpresa->select(
                'id',
                'nombre',
                'ruc',
                'predeterminado'
            )
            ->where('id_cliente',$idCliente->value())
            ->orderBy('nombre', 'asc')->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new EmpresaShort(
                new Id($model->id , false, 'El id de la empresa no tiene el formato correcto'),
                new Text($model->nombre, false, -1, ''),
                new Text($model->ruc, true, -1, ''),
                new ValueBoolean($model->predeterminado)
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

    public function create(
        Text $nombre,
        Text $ruc,
        Text $direccion,
        Text $idUbigeo,
        Id $idCliente,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $count = $this->eloquentModelEmpresa->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La empresa ya se encuentra registrada');
        }

        $count = $this->eloquentModelEmpresa->select('id')->where('id_cliente', $idCliente->value())->where(DB::raw("TRIM(ruc)"), trim($ruc->value()) )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El ruc ya se encuentra registrado');
        }
//        $_codigo = '';
//        if( !is_null($codigo->value())){
//            if(trim($codigo->value()) === '' ){
//                $_codigo = null;
//            }else{
//                $_codigo = $codigo->value();
//            }
//            if($this->eloquentModelEmpresa->select('id')->where('id_cliente', $idCliente->value())->where('codigo', trim($codigo->value()))->count() > 0){
//                throw new \InvalidArgumentException('El código encuentra registrada');
//            }
//        }

        $this->eloquentModelEmpresa->create([
            'nombre' => $nombre->value(),
            'ruc' => $ruc->value(),
            'direccion' => $direccion->value(),
            'id_cliente' => $idCliente->value(),
            'id_ubigeo' => $idUbigeo->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_registro' => $idUsuarioRegistro->value()
        ]);
    }


    public function update(
        Id $id,
        Text $nombre,
        Text $ruc,
        Text $direccion,
        Text $idUbigeo,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void
    {
        $Empresa = $this->eloquentModelEmpresa->findOrFail($id->value());

        $count = $this->eloquentModelEmpresa->select('id')->where('id', '<>', $id->value())->where('id_cliente', $Empresa->id_cliente)->where(DB::raw("UPPER(nombre)"), mb_strtoupper($nombre->value(), 'UTF-8') )->count();
        if($count > 0){
            throw new \InvalidArgumentException('La Empresa ya se encuentra registrada');
        }

        $count = $this->eloquentModelEmpresa->select('id')->where('id', '<>', $id->value())->where('id_cliente', $Empresa->id_cliente)->where(DB::raw("TRIM(ruc)"), trim($ruc->value()) )->count();
        if($count > 0){
            throw new \InvalidArgumentException('El ruc ya se encuentra registrado');
        }
//        $_codigo = "";
//        if( !is_null($codigo->value())){
//            if(trim($codigo->value()) === '' ){
//                $_codigo = null;
//            }else{
//                $_codigo = $codigo->value();
//            }
//            if($this->eloquentModelEmpresa->select('id')->where('id', '<>', $id->value())->where('id_cliente', $Empresa->id_cliente)->where('codigo', trim($codigo->value()))->count() > 0){
//                throw new \InvalidArgumentException('El código encuentra registrada');
//            }
//        }


        $this->eloquentModelEmpresa->findOrFail($id->value())->update([
            'nombre' => $nombre->value(),
            'ruc' => $ruc->value(),
            'direccion' => $direccion->value(),
            'id_ubigeo' => $idUbigeo->value(),
            'id_estado' => $idEstado->value(),
            'id_usu_modifico' => $idUsuarioRegistro->value()
        ]);
    }

    public function changeState(
        Id $idEmpresa,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelEmpresa->findOrFail($idEmpresa->value())->update([
           'id_estado' => $idEstado->value(),
           'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

    public function find(
        Id $idEmpresa,
    ): Empresa
    {
        $model = $this->eloquentModelEmpresa->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->findOrFail($idEmpresa->value());
        $OModel = new Empresa(
            new Id($model->id , false, 'El id de la empresa no tiene el formato correcto'),
            new Text($model->nombre, false, -1, ''),
            new Text($model->ruc, false, -1, ''),
            new Text($model->direccion, false, 150, 'La direccion de la Empresa excede los 150 caracteres'),
            new Text($model->id_ubigeo, true, -1, ''),
            new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
            new ValueBoolean($model->predeterminado),
            new NumericInteger($model->id_estado),
            new NumericInteger($model->id_eliminado),
            new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
            new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
            new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
            new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
        );
        $OModel->setUsuarioRegistro(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, false, -1));
        $OModel->setUsuarioModifico(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
        $OModel->setDepartamento(new Text(!is_null($model->ubigeo) ? $model->ubigeo->departamento : null, true, -1 , ''));
        $OModel->setProvincia(new Text(!is_null($model->ubigeo) ? $model->ubigeo->provincia : null, true, -1 , ''));
        $OModel->setDistrito(new Text(!is_null($model->ubigeo) ? $model->ubigeo->distrito : null, true, -1 , ''));

        return $OModel;
    }



    public function changePredeterminado(
        Id $idCliente,
        Id $idEmpresa,
        Id $idUsuarioModifico
    ): void
    {
        $this->eloquentModelEmpresa
            ->where('id_cliente', $idCliente->value())
            ->where('id', '<>', $idEmpresa->value())
            ->where('predeterminado', true)
            ->update([
                'predeterminado' => false,
                'id_usu_modifico' => $idUsuarioModifico->value()
            ]);

        $this->eloquentModelEmpresa->findOrFail($idEmpresa->value())->update([
            'predeterminado' => true,
            'id_usu_modifico' => $idUsuarioModifico->value()
        ]);
    }

}
