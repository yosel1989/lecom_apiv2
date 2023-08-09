<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class GetListByUsuarioUseCase
{
    private VehiculoRepositoryContract $repository;

    public function __construct(VehiculoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idUsuario): array
    {
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        return $this->repository->listByUsuario($_idUsuario);
    }
}
