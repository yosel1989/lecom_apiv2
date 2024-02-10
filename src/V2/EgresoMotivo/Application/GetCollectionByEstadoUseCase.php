<?php

declare(strict_types=1);

namespace Src\V2\EgresoMotivo\Application;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoMotivo\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\EgresoMotivo\Domain\EgresoMotivoList;

final class GetCollectionByEstadoUseCase
{
    private EgresoRepositoryContract $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idEstado): EgresoMotivoList
    {
        $_idEstado = new NumericInteger($idEstado);
        return $this->repository->collectionByEstado($_idEstado);
    }
}
