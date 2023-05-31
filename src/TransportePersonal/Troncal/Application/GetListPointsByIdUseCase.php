<?php


namespace Src\TransportePersonal\Troncal\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Troncal\Domain\Contracts\TroncalRepositoryContract;

final class GetListPointsByIdUseCase
{
    private $repository;

    public function __construct(TroncalRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idTroncal): array
    {
        $id = new Id($idTroncal,false,'El id del tipo de ruta no tiene el formato válido');
        return $this->repository->listPoints($id);
    }

}
