<?php

declare(strict_types=1);

namespace Src\V2\PerfilModulo\Infrastructure\Repositories;

use App\Models\V2\PerfilModulo as EloquentModelPerfilModulo;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\PerfilModulo\Domain\Contracts\PerfilModuloRepositoryContract;
use Src\V2\PerfilModulo\Domain\PerfilModulo;

final class EloquentPerfilModuloRepository implements PerfilModuloRepositoryContract
{
    private EloquentModelPerfilModulo $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelPerfilModulo;
    }


    public function collectionByClientePerfil(Id $idCliente, Id $idPerfil): array
    {
        $models = $this->eloquent->with(
            'usuarioRegistro:id,nombres,apellidos',
            'usuarioModifico:id,nombres,apellidos'
        )->where('id_cliente',$idCliente->value())->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new PerfilModulo(
                new Id($model->id , false, 'El id del perfil no tiene el formato correcto'),
                new Text($model->nombre, false, 100, 'El nombre del perfil excede los 100 caracteres'),
                new NumericInteger($model->id_nivel_usuario->value),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new NumericInteger($model->id_estado->value),
                new NumericInteger($model->id_eliminado->value),
                new Id($model->id_usu_registro, true, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del usuario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'El formato de la fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'El formato de la fecha de modificación no tiene el formato correcto'),
            );


            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


    public function assign(
        Id $idCliente,
        Id $idPerfil,
        array $modulos,
        Id $idUsuario
    ): void
    {
        if($this->eloquent->where('id_perfil', $idPerfil->value())->count() > 0){
            $this->eloquent->where('id_perfil', $idPerfil->value())->update([
                'modulos' => $modulos,
                'id_usu_registro' => $idUsuario->value()
            ]);
        }else{
            $this->eloquent->create([
               'id_cliente' => $idCliente->value(),
               'id_perfil' => $idPerfil->value(),
               'modulos' => $modulos,
               'id_usu_registro' => $idUsuario->value()
            ]);
        }



    }



}
