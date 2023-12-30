<?php

declare(strict_types=1);

namespace Src\V2\ModuloMenu\Application;

use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;

final class GetListUseCase
{
    private ModuloMenuRepositoryContract $repository;

    public function __construct(ModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
