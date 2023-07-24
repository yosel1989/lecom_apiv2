<?php

declare(strict_types=1);

namespace Src\V2\Paradero\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Paradero\Domain\Contracts\ParaderoRepositoryContract;
use Src\V2\Paradero\Domain\Paradero;

final class FindByIdUseCase
{
    private ParaderoRepositoryContract $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idParadero): Paradero
    {
        $_idParadero = new Id($idParadero,false, 'El id del destino no tiene el formato correcto');
        return $this->repository->find($_idParadero);
    }
}
