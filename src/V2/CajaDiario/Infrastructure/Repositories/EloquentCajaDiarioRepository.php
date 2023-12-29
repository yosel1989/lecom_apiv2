<?php

declare(strict_types=1);

namespace Src\V2\CajaDiario\Infrastructure\Repositories;

use App\Models\V2\CajaDiario as EloquentModelCajaDiario;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
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

}
