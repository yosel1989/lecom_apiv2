<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\DateFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class LiquidarBoletosInterprovincialesUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idLiquidacion,
        string $fechaDesde,
        string $fechaHasta,
        array $idVehiculos
    ): void
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idLiquidacion = new Id($idLiquidacion,false, 'El id de liquidación no tiene el formato correcto');
        $_fechaDesde = new DateFormat($fechaDesde,false, 'La fecha desde no tiene el formato correcto');
        $_fechaHasta = new DateFormat($fechaHasta,false, 'La fecha hasta no tiene el formato correcto');
        $this->repository->liquidar($_idCliente, $_idLiquidacion, $_fechaDesde, $_fechaHasta, $idVehiculos);
    }
}
