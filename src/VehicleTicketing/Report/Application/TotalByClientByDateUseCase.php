<?php


namespace Src\VehicleTicketing\Report\Application;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Domain\Contracts\TicketReportRepositoryContract;

final class TotalByClientByDateUseCase
{
    private $repository;

    public function __construct(TicketReportRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( DateTimeFormat $dateStart,   Id $IdClient, Id $idUser) : array
    {
        return $this->repository->totalByClientByDate(
            $dateStart,
            $IdClient,
            $idUser
        );
    }

}
