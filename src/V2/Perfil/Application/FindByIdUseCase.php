<?php

declare(strict_types=1);

namespace Src\V2\Perfil\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Perfil\Domain\Contracts\PerfilRepositoryContract;
use Src\V2\Perfil\Domain\Perfil;

final class FindByIdUseCase
{
    private PerfilRepositoryContract $repository;

    public function __construct(PerfilRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idPerfil): Perfil
    {
        $_idPerfil = new Id($idPerfil,false, 'El id del perfil no tiene el formato correcto');
        return $this->repository->find($_idPerfil);
    }
}
