<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalAverageTopByClientHourByRangeDateUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $IdClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Numeric $hourStart, Numeric $hourEnd, Id $idUser) : array
    {
        return $this->repository->totalAverageTopByClientHourUseByRange(
            $IdClient,
            $dateStart,
            $dateEnd,
            $hourStart,
            $hourEnd,
            $idUser
        );
    }

}
