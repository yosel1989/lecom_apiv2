<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalAverageByClientHourByRangeDateUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $IdClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idUser) : array
    {
        return $this->repository->totalAverageByClientHourUseByRange(
            $IdClient,
            $dateStart,
            $dateEnd,
            $idUser
        );
    }

}
