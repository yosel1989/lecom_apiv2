<?php

declare(strict_types=1);

namespace Src\V2\IngresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoTipo\Domain\Contracts\IngresoTipoRepositoryContract;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;

final class GetListByClienteUseCase
{
    private IngresoTipoRepositoryContract $repository;

    public function __construct(IngresoTipoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): IngresoTipoShortList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->listByCliente($_idCliente);
    }
}
