<?php

declare(strict_types=1);

namespace Src\V2\TipoSerie\Application;

use Src\V2\TipoSerie\Domain\Contracts\TipoSerieRepositoryContract;

final class GetListUseCase
{
    private TipoSerieRepositoryContract $repository;

    public function __construct(TipoSerieRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
