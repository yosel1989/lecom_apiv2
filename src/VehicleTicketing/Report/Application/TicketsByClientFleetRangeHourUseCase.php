<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TicketsByClientFleetRangeHourUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, int $hourStart,  int $hourEnd) : array
    {
        return $this->repository->ticketsByClientFleetVehicleRangeHour(
            $idClient,
            $dateStart,
            $dateEnd,
            $hourStart,
            $hourEnd
        );
    }

}
