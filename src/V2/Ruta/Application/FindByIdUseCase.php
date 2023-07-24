<?php

declare(strict_types=1);

namespace Src\V2\Ruta\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Ruta\Domain\Contracts\RutaRepositoryContract;
use Src\V2\Ruta\Domain\Ruta;

final class FindByIdUseCase
{
    private RutaRepositoryContract $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idRuta): Ruta
    {
        $_idRuta = new Id($idRuta,false, 'El id del Ruta no tiene el formato correcto');
        return $this->repository->find($_idRuta);
    }
}
