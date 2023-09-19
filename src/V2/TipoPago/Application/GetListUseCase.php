<?php

declare(strict_types=1);

namespace Src\V2\TipoPago\Application;

use Src\V2\TipoPago\Domain\Contracts\TipoPagoRepositoryContract;

final class GetListUseCase
{
    private TipoPagoRepositoryContract $repository;

    public function __construct(TipoPagoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
