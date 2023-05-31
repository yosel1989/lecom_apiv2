<?php

namespace Src\Administracion\Liquidacion\Application;

use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\Administracion\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;

final class CreateUseCase
{
    /**
     * @var LiquidacionRepositoryContract
     */
    private $repository;

    public function __construct( LiquidacionRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $idTipoLiquidacion,
        ?string $fecha,
        ?string $fechaDesde,
        ?string $fechaHasta,
        ?string $idVehiculo,
        ?string $idPersonal,
        ?string $observacion,
        string $idCliente,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $Id = new Id($id,false,'El id del Liquidacion no tiene el formato valido');
        $IdTipoLiquidacion = new Numeric($idTipoLiquidacion,false);
        $Fecha = new DateOnlyFormat($fecha,true,'La fecha tiene un formato invalido');
        $FechaDesde = new DateOnlyFormat($fechaDesde,true,'La fecha de inicio tiene un formato invalido');
        $FechaHasta = new DateOnlyFormat($fechaHasta,true,'La fecha fin tiene un formato invalido');
        $IdVehiculo = new Id($idVehiculo,true,'El id del vehiculo no tiene el formato valido');
        $IdPersonal = new Id($idPersonal,true,'El id del personal no tiene el formato valido');
        $Observacion = new Text($observacion,true, 250,'La observación excede los 250 caracteres');
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato valido');
        $IdEstado = new Numeric($idEstado,false);
        $IdUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario que registro no tiene el formato valido');

        $this->repository->create(
            $Id,
            $IdTipoLiquidacion,
            $Fecha,
            $FechaDesde,
            $FechaHasta,
            $IdVehiculo,
            $IdPersonal,
            $Observacion,
            $IdCliente,
            $IdEstado,
            $IdUsuarioRegistro
        );

    }
}
