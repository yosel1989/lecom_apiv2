<?php

declare(strict_types=1);

namespace Src\V2\CajaTraslado\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CajaTraslado\Domain\Contracts\CajaTrasladoRepositoryContract;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;

final class GetCollectionByClienteUseCase
{
    private CajaTrasladoRepositoryContract $repository;

    public function __construct(CajaTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): CajaTrasladoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
