<?php

declare(strict_types=1);

namespace Src\V2\ClienteMedioPago\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ClienteMedioPago\Domain\Contracts\ClienteMedioPagoRepositoryContract;
use Src\V2\ClienteMedioPago\Domain\ClienteMedioPagoFlujo;

final class GetFlujoToCajaDiarioUseCase
{
    private ClienteMedioPagoRepositoryContract $repository;

    public function __construct(ClienteMedioPagoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idCajaDiario): ClienteMedioPagoFlujo
    {
        $_idCliente = new Id($idCliente, false,'El id del cliente no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario, false,'El id no tiene el formato correcto');
        return $this->repository->flujoToCajaDiario($_idCliente, $_idCajaDiario);
    }
}
