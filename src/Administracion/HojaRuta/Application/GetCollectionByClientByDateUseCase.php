<?php


namespace Src\Administracion\HojaRuta\Application;

use Src\Administracion\HojaRuta\Domain\Contracts\HojaRutaRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetCollectionByClientByDateUseCase
{
    private $repository;

    public function __construct(HojaRutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fechaAsignada): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $dateAssigned = new DateOnlyFormat($fechaAsignada,false,'La fecha asignada no tiene un formato válido');
        return $this->repository->collectionByClientByDate($id, $dateAssigned);
    }

}
