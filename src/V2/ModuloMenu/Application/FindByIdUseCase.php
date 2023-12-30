<?php

declare(strict_types=1);

namespace Src\V2\ModuloMenu\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ModuloMenu\Domain\Contracts\ModuloMenuRepositoryContract;
use Src\V2\ModuloMenu\Domain\ModuloMenu;

final class FindByIdUseCase
{
    private ModuloMenuRepositoryContract $repository;

    public function __construct(ModuloMenuRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idModuloMenu): ModuloMenu
    {
        $_idModuloMenu = new Id($idModuloMenu,false, 'El id del modulo no tiene el formato correcto');
        return $this->repository->find($_idModuloMenu);
    }
}
