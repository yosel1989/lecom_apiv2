<?php

declare(strict_types=1);

namespace Src\V2\Caja\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Caja\Domain\Contracts\CajaRepositoryContract;

final class GetListBySedePuntoVentaUseCase
{
    private CajaRepositoryContract $repository;

    public function __construct(CajaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idSede): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false, 'El id de la sede no tiene el formato correcto');
        return $this->repository->listBySedePuntoVenta($_idCliente, $_idSede);
    }
}
