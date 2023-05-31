<?php


namespace Src\TransportePersonal\Paradero\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class GetListHoursByIdUseCase
{
    private $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idParadero): array
    {
        $id = new Id($idParadero,false,'El id del paradero no tiene el formato válido');
        return $this->repository->listHours($id);
    }

}
