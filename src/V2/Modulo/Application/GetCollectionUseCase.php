<?php

declare(strict_types=1);

namespace Src\V2\Modulo\Application;

use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;

final class GetCollectionUseCase
{
    private ModuloRepositoryContract $repository;

    public function __construct(ModuloRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
