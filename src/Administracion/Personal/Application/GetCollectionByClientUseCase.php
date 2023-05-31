<?php


namespace Src\Administracion\Personal\Application;

use Src\Administracion\Personal\Domain\Contracts\PersonalRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(PersonalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
