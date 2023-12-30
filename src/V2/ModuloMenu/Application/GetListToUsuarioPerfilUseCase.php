<?php

declare(strict_types=1);

namespace Src\V2\ModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;

final class GetListToUsuarioPerfilUseCase
{
    private ModuloMenuRepositoryContract $repository;

    public function __construct(ModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $idPerfil
    ): array
    {
        $_idPerfil = new Id($idPerfil, false, 'El id del perfil no tiene el formato correcto');
        return $this->repository->listToUsuarioPerfil($_idPerfil);
    }
}
