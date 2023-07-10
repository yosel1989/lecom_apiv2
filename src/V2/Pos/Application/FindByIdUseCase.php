<?php

declare(strict_types=1);

namespace Src\V2\Pos\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Pos\Domain\Contracts\PosRepositoryContract;
use Src\V2\Pos\Domain\Pos;

final class FindByIdUseCase
{
    private PosRepositoryContract $repository;

    public function __construct(PosRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idPos): Pos
    {
        $_idPos = new Id($idPos,false, 'El id del pos no tiene el formato correcto');
        return $this->repository->find($_idPos);
    }
}
