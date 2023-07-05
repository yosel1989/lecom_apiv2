<?php

declare(strict_types=1);

namespace Src\V2\Usuario\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Usuario\Domain\Contracts\UsuarioRepositoryContract;
use Src\V2\Usuario\Domain\Usuario;

final class FindByIdUseCase
{
    private UsuarioRepositoryContract $repository;

    public function __construct(UsuarioRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idUsuario): Usuario
    {
        $_idUsuario = new Id($idUsuario,false, 'El id del usuario no tiene el formato correcto');
        return $this->repository->find($_idUsuario);
    }
}
