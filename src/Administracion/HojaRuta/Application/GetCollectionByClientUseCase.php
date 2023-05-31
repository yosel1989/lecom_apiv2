<?php


namespace Src\Administracion\HojaRuta\Application;

use Src\Administracion\HojaRuta\Domain\Contracts\HojaRutaRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(HojaRutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
