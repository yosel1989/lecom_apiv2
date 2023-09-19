<?php

declare(strict_types=1);

namespace Src\V2\TipoMoneda\Application;

use Src\V2\TipoMoneda\Domain\Contracts\TipoMonedaRepositoryContract;

final class GetListUseCase
{
    private TipoMonedaRepositoryContract $repository;

    public function __construct(TipoMonedaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
