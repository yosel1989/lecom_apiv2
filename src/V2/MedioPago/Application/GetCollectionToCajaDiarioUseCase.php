<?php

declare(strict_types=1);

namespace Src\V2\MedioPago\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\MedioPago\Domain\Contracts\MedioPagoRepositoryContract;
use Src\V2\MedioPago\Domain\MedioPagoShortList;

final class GetCollectionToCajaDiarioUseCase
{
    private MedioPagoRepositoryContract $repository;

    public function __construct(MedioPagoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idCajaDiario): MedioPagoShortList
    {
        $_idCliente = new Id($idCliente, false,'El id del cliente no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario, false,'El id no tiene el formato correcto');
        return $this->repository->collectionToCajaDiario($_idCliente, $_idCajaDiario);
    }
}
