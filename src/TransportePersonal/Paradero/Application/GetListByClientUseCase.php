<?php


namespace Src\TransportePersonal\Paradero\Application;


use Src\ModelBase\Domain\ValueObjects\Id;
use Src\TransportePersonal\Paradero\Domain\Contracts\ParaderoRepositoryContract;

final class GetListByClientUseCase
{
    private $repository;

    public function __construct(ParaderoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idCliente): array
    {
        $id = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        return $this->repository->listByClient($id);
    }

}
