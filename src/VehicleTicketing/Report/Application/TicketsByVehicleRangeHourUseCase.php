<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TicketsByVehicleRangeHourUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $idVehicle, DateTimeFormat $date, int $hourStart,  int $hourEnd) : array
    {
        return $this->repository->ticketsByVehicleRange(
            $idVehicle,
            $date,
            $hourStart,
            $hourEnd
        );
    }

}
