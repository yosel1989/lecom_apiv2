<?php

declare(strict_types=1);

namespace Src\V2\Vehiculo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;

final class AsignarUsuarioUseCase
{
    private VehiculoRepositoryContract $repository;

    public function __construct(VehiculoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idUsuario, string $idVehiculos, string $idUsuarioRegistro): void
    {
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        $_vehiculos = new Text($idVehiculos,false, -1);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false, 'El id del usuario que registra no tiene el formato correcto');

        $this->repository->asignarUsuario($_idUsuario, $_vehiculos, $_idUsuarioRegistro);
    }
}
