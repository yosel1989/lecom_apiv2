<?php

declare(strict_types=1);

namespace Src\V2\BoletoPrecio\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\BoletoPrecio\Domain\Contracts\BoletoPrecioRepositoryContract;
use Src\V2\BoletoPrecio\Domain\BoletoPrecio;

final class FindByIdUseCase
{
    private BoletoPrecioRepositoryContract $repository;

    public function __construct(BoletoPrecioRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idBoletoPrecio): BoletoPrecio
    {
        $_idBoletoPrecio = new Id($idBoletoPrecio,false, 'El id del viaje no tiene el formato correcto');
        return $this->repository->find($_idBoletoPrecio);
    }
}
