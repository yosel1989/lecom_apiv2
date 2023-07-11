<?php

declare(strict_types=1);

namespace Src\V2\Destino\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Destino\Domain\Contracts\DestinoRepositoryContract;
use Src\V2\Destino\Domain\Destino;

final class FindByIdUseCase
{
    private DestinoRepositoryContract $repository;

    public function __construct(DestinoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idDestino): Destino
    {
        $_idDestino = new Id($idDestino,false, 'El id del destino no tiene el formato correcto');
        return $this->repository->find($_idDestino);
    }
}
