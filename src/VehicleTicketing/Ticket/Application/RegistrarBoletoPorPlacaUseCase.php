<?php


namespace Src\VehicleTicketing\Ticket\Application;


use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;

final class RegistrarBoletoPorPlacaUseCase
{
    /**
     * @var TicketRepositoryContract
     */
    private $repository;

    public function __construct( TicketRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        Id $idBoleto,
        Id $idVehiculo,
        Id $idRuta,
        Numeric $latitud,
        Numeric $longitud,
        DateTimeFormat $fecha,
        Numeric $monto,
        Text $numeroBoleto,
        Text $dni,
        DateOnlyFormat $reserved
    ): void
    {
        $this->repository->registrarBoletoPorPlaca(
            $idBoleto,
            $idVehiculo,
            $idRuta,
            $latitud,
            $longitud,
            $fecha,
            $monto,
            $numeroBoleto,
            $dni,
            $reserved
        );
    }
}
