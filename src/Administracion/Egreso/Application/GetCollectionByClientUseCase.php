<?php


namespace Src\Administracion\Egreso\Application;

use Src\Administracion\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
