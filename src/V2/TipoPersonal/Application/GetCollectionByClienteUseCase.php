<?php

declare(strict_types=1);

namespace Src\V2\TipoPersonal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\TipoPersonal\Domain\Contracts\TipoPersonalRepositoryContract;
use Src\V2\TipoPersonal\Domain\TipoPersonalList;

final class GetCollectionByClienteUseCase
{
    private TipoPersonalRepositoryContract $repository;

    public function __construct(TipoPersonalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): TipoPersonalList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
