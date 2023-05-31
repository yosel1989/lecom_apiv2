<?php


namespace Src\TransportePersonal\Ruta\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Ruta\Domain\Contracts\RutaRepositoryContract;

final class GetListVehiclesByIdUseCase
{
    private $repository;

    public function __construct(RutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idRuta): array
    {
        $id = new Id($idRuta,false,'El id del tipo de ruta no tiene el formato válido');
        return $this->repository->listVehicles($id);
    }

}
