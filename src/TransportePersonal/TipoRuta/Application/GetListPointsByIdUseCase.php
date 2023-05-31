<?php


namespace Src\TransportePersonal\TipoRuta\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\TipoRuta\Domain\Contracts\TipoRutaRepositoryContract;

final class GetListPointsByIdUseCase
{
    private $repository;

    public function __construct(TipoRutaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idTipoRuta): array
    {
        $id = new Id($idTipoRuta,false,'El id del tipo de ruta no tiene el formato válido');
        return $this->repository->listPoints($id);
    }

}
