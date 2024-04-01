<?php

declare(strict_types=1);

namespace Src\V2\Genero\Application;

use Src\V2\Genero\Domain\Contracts\GeneroRepositoryContract;

final class GetListUseCase
{
    private GeneroRepositoryContract $repository;

    public function __construct(GeneroRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
