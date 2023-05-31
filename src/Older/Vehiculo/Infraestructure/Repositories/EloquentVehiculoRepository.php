<?php


namespace Src\Older\Vehiculo\Infraestructure\Repositories;


use App\Models\Older\Vehiculo as EloquentVehiculoModel;
use Src\Older\Vehiculo\Domain\Contracts\VehiculoRepositoryContract;
use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoPlaca;
use Src\Older\Vehiculo\Domain\Vehiculo;
use Src\Older\Vehiculo\Domain\ValueObjects\VehiculoId;

final class EloquentVehiculoRepository implements VehiculoRepositoryContract
{
    /**
     * @var EloquentVehiculoModel
     */
    private $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentVehiculoModel;
    }

    public function find( VehiculoId $id ): ?Vehiculo
    {
        $Vehiculo = $this->eloquentClientModel->findOrFail($id->value());

        return new Vehiculo(
            new VehiculoId($Vehiculo->vehiculo_id),
            new VehiculoPlaca($Vehiculo->vehiculo_placa)
        );
    }

}
