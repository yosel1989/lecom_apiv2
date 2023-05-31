<?php


namespace Src\Administracion\TipoEgreso\Application;

use Src\Administracion\TipoEgreso\Domain\Contracts\TipoEgresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetListByClientUseCase
{
    private $repository;

    public function __construct(TipoEgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
