<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalByFleetRangeDateUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $idCLient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idUser) : array
    {
        return $this->repository->totalByFleetRangeDate(
            $idCLient,
            $dateStart,
            $dateEnd,
            $idUser
        );
    }

}
