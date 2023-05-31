<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalAverageByFleetHourUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $IdClient) : array
    {
        return $this->repository->totalAverageByFleetHour(
            $dateStart,
            $dateEnd,
            $IdClient
        );
    }

}
