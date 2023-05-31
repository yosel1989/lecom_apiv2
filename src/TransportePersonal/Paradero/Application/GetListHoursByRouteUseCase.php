<?php


namespace Src\TransportePersonal\Paradero\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class GetListHoursByRouteUseCase
{
    private $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idRuta): array
    {
        $id = new Id($idRuta,false,'El id de la ruta no tiene el formato válido');
        return $this->repository->listHoursByRoute($id);
    }

}
