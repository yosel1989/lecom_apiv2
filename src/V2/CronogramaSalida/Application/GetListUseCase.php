<?php

declare(strict_types=1);

namespace Src\V2\CronogramaSalida\Application;

use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class GetListUseCase
{
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct(CronogramaSalidaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
