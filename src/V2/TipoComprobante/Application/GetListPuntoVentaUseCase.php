<?php

declare(strict_types=1);

namespace Src\V2\TipoComprobante\Application;

use Src\V2\TipoComprobante\Domain\Contracts\TipoComprobanteRepositoryContract;

final class GetListPuntoVentaUseCase
{
    private TipoComprobanteRepositoryContract $repository;

    public function __construct(TipoComprobanteRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->listPuntoVenta();
    }
}
