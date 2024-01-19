<?php

declare(strict_types=1);

namespace Src\V2\EgresoTipo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\EgresoTipo\Domain\Contracts\EgresoTipoRepositoryContract;
use Src\V2\EgresoTipo\Domain\EgresoTipoList;

final class GetCollectionByClienteUseCase
{
    private EgresoTipoRepositoryContract $repository;

    public function __construct(EgresoTipoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): EgresoTipoList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
