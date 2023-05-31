<?php


namespace Src\Administracion\Egreso\Application;

use Src\Administracion\Egreso\Domain\Contracts\EgresoRepositoryContract;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\Id;

final class GetLiquidacionDiariaBusUseCase
{
    private $repository;

    public function __construct(EgresoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCliente, string $fecha, string $idVehiculo): array
    {
        $IdCliente = new Id($idCliente,false,'El id del cliente no tiene el formato válido');
        $date = new DateOnlyFormat($fecha,false,'La fecha tiene un formato inválido');
        $IdVehiculo = new Id($idVehiculo,false,'El id del vehiculo no tiene el formato válido');
//        $IdPersonal = new Id($idPersonal,false,'El id del personal no tiene el formato válido');

        return $this->repository->liquidacionDiariaBus($date, $IdCliente, $IdVehiculo);
    }

}
