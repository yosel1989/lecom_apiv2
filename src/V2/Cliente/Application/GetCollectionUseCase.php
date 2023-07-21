<?php

declare(strict_types=1);

namespace Src\V2\Cliente\Application;

use Src\V2\Cliente\Domain\Contracts\ClienteRepositoryContract;

final class GetCollectionUseCase
{
    private ClienteRepositoryContract $repository;

    public function __construct(ClienteRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection();
    }
}
