<?php

namespace Src\V2\CajaDiario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\CajaDiario\Domain\Contracts\CajaDiarioRepositoryContract;

final class MontoActualUseCase
{
    /**
     * @var CajaDiarioRepositoryContract
     */
    private CajaDiarioRepositoryContract $repository;

    public function __construct( CajaDiarioRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idCaja,
        string $idCliente
    ): CajaSede
    {
        $_idCaja = new Id($idCaja,false,'El id de la caja no tiene el formato correcto');
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');

        return $this->repository->montoActual(
            $_idCaja,
            $_idCliente
        );

    }
}
