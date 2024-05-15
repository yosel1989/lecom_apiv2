<?php

declare(strict_types=1);

namespace Src\V2\Cronograma\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;
use Src\V2\Cronograma\Domain\CronogramaList;

final class GetCollectionByClienteUseCase
{
    private CronogramaRepositoryContract $repository;

    public function __construct(CronogramaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): CronogramaList
    {
        $_idCliente = new Id($idCliente,false, 'El id del cliente no tiene el formato correcto');
        return $this->repository->collectionByCliente($_idCliente);
    }
}
