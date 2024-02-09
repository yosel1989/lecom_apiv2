<?php

declare(strict_types=1);

namespace Src\V2\LiquidacionMotivo\Application;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\LiquidacionMotivo\Domain\Contracts\LiquidacionRepositoryContract;
use Src\V2\LiquidacionMotivo\Domain\LiquidacionMotivoList;

final class GetCollectionByEstadoUseCase
{
    private LiquidacionRepositoryContract $repository;

    public function __construct(LiquidacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idEstado): LiquidacionMotivoList
    {
        $_idEstado = new NumericInteger($idEstado);
        return $this->repository->collectionByEstado($_idEstado);
    }
}
