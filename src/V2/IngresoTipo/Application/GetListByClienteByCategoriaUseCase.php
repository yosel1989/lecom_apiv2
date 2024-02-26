<?php

declare(strict_types=1);

namespace Src\V2\IngresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\IngresoTipo\Domain\Contracts\IngresoTipoRepositoryContract;
use Src\V2\IngresoTipo\Domain\IngresoTipoShortList;

final class GetListByClienteByCategoriaUseCase
{
    private IngresoTipoRepositoryContract $repository;

    public function __construct(IngresoTipoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idCategoria): IngresoTipoShortList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idCategoria = new Id($idCategoria,false, 'El id de la categoria no tiene el formato correcto');
        return $this->repository->listByClienteByCategoria($_idCliente, $_idCategoria);
    }
}
