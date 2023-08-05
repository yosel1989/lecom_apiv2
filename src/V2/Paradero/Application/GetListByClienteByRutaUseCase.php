<?php

declare(strict_types=1);

namespace Src\V2\Paradero\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class GetListByClienteByRutaUseCase
{
    private ParaderoRepositoryContract $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $idRuta): array
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        $_idRuta = new Id($idRuta,false, 'El id de la ruta no tiene el formato correcto');
        return $this->repository->listByClienteByRuta($_idCliente, $_idRuta);
    }
}
