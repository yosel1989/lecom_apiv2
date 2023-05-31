<?php


namespace Src\Administracion\Ingreso\Application;

use Src\Administracion\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(IngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
