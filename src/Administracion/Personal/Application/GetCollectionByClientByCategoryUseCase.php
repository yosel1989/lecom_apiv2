<?php

namespace Src\Administracion\Personal\Application;

use Src\Administracion\Personal\Domain\Contracts\PersonalRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;

final class GetCollectionByClientByCategoryUseCase
{
    private $repository;

    public function __construct(PersonalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, int $codigoCategoria): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $code = new Numeric($codigoCategoria,false);
        return $this->repository->collectionByClientByCategory($id, $code);
    }

}
