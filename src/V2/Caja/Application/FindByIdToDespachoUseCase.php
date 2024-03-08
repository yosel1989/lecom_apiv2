<?php

declare(strict_types=1);

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;
use Src\V2\Caja\Domain\Caja;

final class FindByIdToDespachoUseCase
{
    private CajaRepositoryContract $repository;

    public function __construct(CajaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCaja, string $idCajaDiario): CajaSede
    {
        $_idCaja = new Id($idCaja,false, 'El id del caja no tiene el formato correcto');
        $_idCajaDiario = new Id($idCajaDiario,false, 'El id del caja diario no tiene el formato correcto');
        return $this->repository->findToDespacho($_idCaja, $_idCajaDiario);
    }
}
