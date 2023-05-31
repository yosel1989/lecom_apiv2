<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalByVehicleByTurnUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Id $idVehicle, DateTimeFormat $dateStart) : array
    {
        return $this->repository->totalByVehicleByTurn(
            $idVehicle,
            $dateStart
        );
    }

}
