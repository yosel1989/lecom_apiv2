<?php

declare(strict_types=1);

namespace Src\V2\LiquidacionEstadoMotivo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\LiquidacionEstadoMotivo\Domain\Contracts\LiquidacionEstadoMotivoRepositoryContract;
use Src\V2\LiquidacionEstadoMotivo\Domain\LiquidacionEstadoMotivoList;

final class GetCollectionByEstadoUseCase
{
    private LiquidacionEstadoMotivoRepositoryContract $repository;

    public function __construct(LiquidacionEstadoMotivoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idLiquidacion): LiquidacionEstadoMotivoList
    {
        $_idLiquidacion = new Id($idLiquidacion, false, 'El id de la liquidación no tiene el formato correcto');
        return $this->repository->collectionByLiquidacion($_idLiquidacion);
    }
}
