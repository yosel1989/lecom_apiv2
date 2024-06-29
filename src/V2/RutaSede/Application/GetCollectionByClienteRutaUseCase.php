<?php

declare(strict_types=1);

namespace Src\V2\RutaSede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\RutaSede\Domain\Contracts\RutaSedeRepositoryContract;

final class GetCollectionByClienteRutaUseCase
{
    private RutaSedeRepositoryContract $repository;

    public function __construct(RutaSedeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idRuta): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        return $this->repository->collectionByClienteRuta($_idCliente, $_idRuta);
    }
}
