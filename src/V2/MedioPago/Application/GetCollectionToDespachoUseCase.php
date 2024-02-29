<?php

declare(strict_types=1);

namespace Src\V2\MedioPago\Application;

use Src\V2\MedioPago\Domain\Contracts\MedioPagoRepositoryContract;
use Src\V2\MedioPago\Domain\MedioPagoShortList;

final class GetCollectionToDespachoUseCase
{
    private MedioPagoRepositoryContract $repository;

    public function __construct(MedioPagoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): MedioPagoShortList
    {
        return $this->repository->collectionToDespacho();
    }
}
