<?php

declare(strict_types=1);

namespace Src\V2\Sede\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Sede\Domain\Contracts\SedeRepositoryContract;
use Src\V2\Sede\Domain\Sede;

final class FindByIdUseCase
{
    private SedeRepositoryContract $repository;

    public function __construct(SedeRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idSede): Sede
    {
        $_idSede = new Id($idSede,false, 'El id del sede no tiene el formato correcto');
        return $this->repository->find($_idSede);
    }
}
