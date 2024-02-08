<?php

declare(strict_types=1);

namespace Src\V2\BoletoInterprovincial\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoInterprovincial\Domain\Contracts\BoletoInterprovincialRepositoryContract;

final class LiberarLiquidacionUseCase
{
    private BoletoInterprovincialRepositoryContract $repository;

    public function __construct(BoletoInterprovincialRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCliente,
        string $idLiquidacion
    ): void
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idLiquidacion = new Id($idLiquidacion,false, 'El id de liquidación no tiene el formato correcto');
        $this->repository->liberarLiquidacion($_idCliente, $_idLiquidacion);
    }
}
