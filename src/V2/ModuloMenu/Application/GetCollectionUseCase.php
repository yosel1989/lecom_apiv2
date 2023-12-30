<?php

declare(strict_types=1);

namespace Src\V2\ModuloMenu\Application;

use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;

final class GetCollectionUseCase
{
    private ModuloMenuRepositoryContract $repository;

    public function __construct(ModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $idModulo): array
    {
        $_idModulo = new NumericInteger($idModulo);
        return $this->repository->collection($_idModulo);
    }
}
