<?php


namespace Src\Administracion\Ingreso\Application;

use Src\Administracion\Ingreso\Domain\Contracts\IngresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientByDateUseCase
{
    private $repository;

    public function __construct(IngresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fecha): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $date = new DateOnlyFormat($fecha,false,'La fecha tiene un formato inválido');
        return $this->repository->collectionByClientByDate($id, $date);
    }

}
