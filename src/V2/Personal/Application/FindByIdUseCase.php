<?php

declare(strict_types=1);

namespace Src\V2\Personal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Personal\Domain\Contracts\PersonalRepositoryContract;
use Src\V2\Personal\Domain\Personal;

final class FindByIdUseCase
{
    private PersonalRepositoryContract $repository;

    public function __construct(PersonalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idPersonal): Personal
    {
        $_idPersonal = new Id($idPersonal,false, 'El id del vehiculo no tiene el formato correcto');
        return $this->repository->find($_idPersonal);
    }
}
