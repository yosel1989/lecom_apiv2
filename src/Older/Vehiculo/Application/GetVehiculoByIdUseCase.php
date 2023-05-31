<?php


namespace Src\Older\Vehiculo\Application;


use Src\Older\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoId;
use Src\Older\Vehiculo\Domain\Vehiculo;

final class GetVehiculoByIdUseCase
{
    private $repository;

    public function __construct( VehiculoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id ): ?Vehiculo
    {
        $Vid = new VehiculoId($id);
        return $this->repository->find($Vid);
    }
}
