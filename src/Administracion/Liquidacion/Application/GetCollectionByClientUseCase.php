<?php


namespace Src\Administracion\Liquidacion\Application;

use Src\Administracion\Liquidacion\Domain\Contracts\LiquidacionRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientUseCase
{
    private $repository;

    public function __construct(LiquidacionRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->collectionByClient($id);
    }

}
