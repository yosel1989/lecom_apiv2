<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalByVehicleDatesUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( DateTimeFormat $dateStart, DateTimeFormat $dateEnd,  Id $IdVehicle) : array
    {
        return $this->repository->totalByVehicleDates(
            $dateStart,
            $dateEnd,
            $IdVehicle
        );
    }

}
