<?php


namespace Src\Administracion\Ruta\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\Administracion\Ruta\Domain\Contracts\RutaRepositoryContract;

final class GetCollectionActivedByClientUseCase
{
    private $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionActivedByClient($id);
    }

}
