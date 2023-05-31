<?php


namespace Src\Administracion\MotivoAnulacion\Application;

use Src\Administracion\MotivoAnulacion\Domain\Contracts\MotivoAnulacionRepositoryContract;
//use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionUseCase
{
    private $repository;

    public function __construct(MotivoAnulacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
//        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collection();
    }

}
