<?php

declare(strict_types=1);

namespace Src\V2\OrigenBoleto\Application;

use Src\V2\OrigenBoleto\Domain\Contracts\OrigenBoletoRepositoryContract;
use Src\V2\OrigenBoleto\Domain\OrigenBoletoShortList;

final class GetListUseCase
{
    private OrigenBoletoRepositoryContract $repository;

    public function __construct(OrigenBoletoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): OrigenBoletoShortList
    {
        return $this->repository->list();
    }
}
