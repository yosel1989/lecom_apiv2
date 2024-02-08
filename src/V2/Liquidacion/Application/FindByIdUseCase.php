<?php

declare(strict_types=1);

namespace Src\V2\Liquidacion\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\V2\Liquidacion\Domain\Liquidacion;

final class FindByIdUseCase
{
    private LiquidacionRepositoryContract $repository;

    public function __construct(LiquidacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idLiquidacion): Liquidacion
    {
        $_idLiquidacion = new Id($idLiquidacion,false, 'El id del Liquidacion no tiene el formato correcto');
        return $this->repository->find($_idLiquidacion);
    }
}
