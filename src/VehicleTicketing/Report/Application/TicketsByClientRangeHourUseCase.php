<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TicketsByClientRangeHourUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $idClient, DateTimeFormat $date, int $hourStart,  int $hourEnd, Id $idUser) : array
    {
        return $this->repository->ticketsByClientVehicleRangeHour(
            $idClient,
            $date,
            $hourStart,
            $hourEnd,
            $idUser
        );
    }

}
