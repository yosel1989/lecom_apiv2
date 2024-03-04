<?php

declare(strict_types=1);

namespace Src\V2\CajaDiario\Infrastructure\Repositories;

use App\Models\V2\CajaDiario as EloquentModelCajaDiario;
use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\CajaDiario\Domain\CajaDiarioReporte;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class EloquentCajaDiarioRepository implements CajaDiarioRepositoryContract
{
    private EloquentModelCajaDiario $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelCajaDiario = new EloquentModelCajaDiario;
    }

    public function open(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoInicial,
        DateTimeFormat $fechaApertura,
        Id $idUsuarioRegistro,
    ): void
    {
        $this->eloquentModelCajaDiario->create([
            'id_caja' =>  $idCaja->value(),
            'id_ruta' =>  $idRuta->value(),
            'id_cliente' =>  $idCliente->value(),
            'monto_inicial' =>  $montoInicial->value(),
            'f_apertura' =>  $fechaApertura->value(),
            'id_usu_registro' =>  $idUsuarioRegistro->value(),
        ]);
    }

    public function close(
        Id $idCaja,
        Id $idRuta,
        Id $idCliente,
        NumericFloat $montoFinal,
        DateTimeFormat $fechaCierre,
        Id $idUsuarioRegistro,
    ): void
    {
        $this->eloquentModelCajaDiario
            ->where('id_caja',$idCaja->value())
            ->where('id_ruta',$idRuta->value())
            ->where('id_cliente',$idCliente->value())
            ->firstOrFail()->update([
                'monto_final' =>  $montoFinal->value(),
                'f_cierre' =>  $fechaCierre->value(),
                'id_usu_modifico' =>  $idUsuarioRegistro->value(),
            ]);
    }

    public function abrir(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro,
    ): void
    {
        $fecha = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $this->eloquentModelCajaDiario->create([
            'id_caja' =>  $idCaja->value(),
            'id_cliente' =>  $idCliente->value(),
            'monto_inicial' =>  $monto->value(),
            'f_apertura' =>  $fecha,
            'id_usu_registro' =>  $idUsuarioRegistro->value(),
        ]);
    }

    public function cerrar(
        Id $idCaja,
        Id $idCliente,
        NumericFloat $monto,
        Id $idUsuarioRegistro,
    ): void
    {
        $fecha = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $select = $this->eloquentModelCajaDiario
            ->where('id_caja',$idCaja->value())
            ->where('id_cliente',$idCliente->value())
            ->whereNull('f_cierre');

        if($select->count() === 0){
            throw new \InvalidArgumentException('La caja ya se encuentra cerrada');
        }

        $select->firstOrFail()->update([
                'monto_final' =>  $monto->value(),
                'f_cierre' =>  $fecha,
                'id_usu_modifico' =>  $idUsuarioRegistro->value(),
            ]);
    }



    public function reporte(
        Id $idCliente,
        DateFormat $fechaInicio,
        DateFormat $fechaFinal
    ): array
    {
        $collection = [];

        $result = $this->eloquentModelCajaDiario
            ->with(
                'caja:id,nombre',
                'ruta:id,nombre',
                'usuarioRegistro:id,nombres,apellidos',
                'usuarioModifico:id,nombres,apellidos',
                'estado:id,nombre',
            )
            ->where('id_cliente',$idCliente->value())
            ->whereDate('f_apertura', '>=', $fechaInicio->value())
            ->whereDate('f_apertura', '<=', $fechaFinal->value())
            ->orderBy('f_apertura','DESC')
            ->get();

        foreach ($result as $model) {
            $OModel = new CajaDiarioReporte(
                new Id($model->id, false,  'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false,  'E id del cliente no tiene el formato correcto'),
                new Id($model->id_caja, false,  'El id de la caja no tiene el formato correcto'),
                new Id(null, true, ''),
                new Id($model->id_usu_registro, false, 'El id del usuario que aperturo la caja no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true,  'El id del usuario que cerro la caja no tiene el formato correcto'),
                new DateTimeFormat($model->f_apertura, false, 'La fecha de apertura no tiene el formato correcto'),
                new DateTimeFormat($model->f_cierre, true, 'La fecha de cierre no tiene el formato correcto'),
                new NumericFloat($model->monto_inicial),
                new NumericFloat($model->monto_final),
                new NumericInteger($model->id_estado)
            );
            $OModel->setUsuarioAperturo(new Text(!is_null($model->usuarioRegistro) ? ( $model->usuarioRegistro->nombres . ' ' . $model->usuarioRegistro->apellidos ) : null, true, -1));
            $OModel->setUsuarioCerro(new Text(!is_null($model->usuarioModifico) ? ( $model->usuarioModifico->nombres . ' ' . $model->usuarioModifico->apellidos ) : null, true, -1));
            $OModel->setEstado(new Text( $model->estado->nombre , true, -1));
            $OModel->setCaja(new Text( $model->caja->nombre , true, -1));

            $collection[] = $OModel;
        }


        return $collection;
    }

}
