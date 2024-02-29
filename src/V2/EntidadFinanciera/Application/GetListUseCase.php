<?php

declare(strict_types=1);

namespace Src\V2\EntidadFinanciera\Application;

use Src\V2\EntidadFinanciera\Domain\Contracts\EntidadFinancieraRepositoryContract;
use Src\V2\EntidadFinanciera\Domain\EntidadFinancieraList;

final class GetListUseCase
{
    private EntidadFinancieraRepositoryContract $repository;

    public function __construct(EntidadFinancieraRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): EntidadFinancieraList
    {
        return $this->repository->list();
    }
}
