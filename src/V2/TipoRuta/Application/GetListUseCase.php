<?php

declare(strict_types=1);

namespace Src\V2\TipoRuta\Application;

use Src\V2\TipoRuta\Domain\Contracts\TipoRutaRepositoryContract;

final class GetListUseCase
{
    private TipoRutaRepositoryContract $repository;

    public function __construct(TipoRutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
