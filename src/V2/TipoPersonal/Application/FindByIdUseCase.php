<?php

declare(strict_types=1);

namespace Src\V2\TipoPersonal\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\TipoPersonal\Domain\Contracts\TipoPersonalRepositoryContract;
use Src\V2\TipoPersonal\Domain\TipoPersonal;

final class FindByIdUseCase
{
    private TipoPersonalRepositoryContract $repository;

    public function __construct(TipoPersonalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idTipoPersonal): TipoPersonal
    {
        $_idTipoPersonal = new Id($idTipoPersonal,false, 'El id del TipoPersonal no tiene el formato correcto');
        return $this->repository->find($_idTipoPersonal);
    }
}
