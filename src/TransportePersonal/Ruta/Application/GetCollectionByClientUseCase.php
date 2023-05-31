<?php


namespace Src\TransportePersonal\Ruta\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
