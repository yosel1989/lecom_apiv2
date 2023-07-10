<?php

declare(strict_types=1);

namespace Src\V2\Modulo\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Modulo\Domain\Contracts\ModuloRepositoryContract;
use Src\V2\Modulo\Domain\Modulo;

final class FindByIdUseCase
{
    private ModuloRepositoryContract $repository;

    public function __construct(ModuloRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idModulo): Modulo
    {
        $_idModulo = new Id($idModulo,false, 'El id del modulo no tiene el formato correcto');
        return $this->repository->find($_idModulo);
    }
}
