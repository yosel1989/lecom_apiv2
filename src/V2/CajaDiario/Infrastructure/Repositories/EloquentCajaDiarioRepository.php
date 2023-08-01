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
            'idCaja' =>  $idCaja->value(),
            'idRuta' =>  $idRuta->value(),
            'idCliente' =>  $idCliente->value(),
            'montoInicial' =>  $montoInicial->value(),
            'fechaApertura' =>  $fechaApertura->value(),
            'idUsuarioRegistro' =>  $idUsuarioRegistro->value(),
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
            ->where('idCaja',$idCaja->value())
            ->where('idRuta',$idRuta->value())
            ->where('idCliente',$idCliente->value())
            ->firstOrFail()->update([
                'montoFinal' =>  $montoFinal->value(),
                'fechaCierre' =>  $fechaCierre->value(),
                'idUsuarioModifico' =>  $idUsuarioRegistro->value(),
            ]);
    }

}
