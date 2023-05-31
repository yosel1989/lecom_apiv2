<?php


namespace Src\Administracion\TipoIngreso\Application;

use Src\Administracion\TipoIngreso\Domain\Contracts\TipoIngresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetListByClientUseCase
{
    private $repository;

    public function __construct(TipoIngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
