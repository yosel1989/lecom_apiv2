<?php


namespace Src\VehicleTicketing\Report\Domain\Contracts;


use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;

interface TicketReportRepositoryContract
{
    public function totalByVehicleByTurn(Id $idVehicle, DateTimeFormat $date): array;
    public function totalByVehicle(DateTimeFormat $start, DateTimeFormat $end, Id $idVehicle, Id $idUser): array;
    public function totalTopByFleet(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array;
    public function rankingTicketTopByFleet(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array;
    public function totalByClientByDate(DateTimeFormat $start,  Id $idClient, Id $idUser): array;
    public function topTotalByClientByDate( DateTimeFormat $dateStart, Id $IdClient, int $hourStart, int $hourEnd, Id $idUser): array;
    public function totalByVehicleDates(DateTimeFormat $start, DateTimeFormat $end, Id $idVehicle): array;
    public function totalByRangeDayByClient(DateTimeFormat $start, DateTimeFormat $end, Id $idClient, Id $idUser): array;
    public function totalByVehicleHour(DateTimeFormat $date, Id $idVehicle): array;
    public function totalAverageByClientHourUseByRange(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idUser): array;
    public function totalAverageTopByClientHourUseByRange(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Numeric $hourStar, Numeric $hourEnd, Id $idUser): array;
    public function totalByFleetRangeDate(Id $idClient, DateTimeFormat $start, DateTimeFormat $end, Id $idUser): array;
    public function totalByClientHour(DateTimeFormat $date, Id $idClient, Id $idUser): array;
    public function totalAverageByFleetHour(DateTimeFormat $dateStart, DateTimeFormat $dateEnd, Id $idClient): array;
    public function ticketsByVehicleRange(Id $idVehicle, DateTimeFormat $date, int $hourStart,  int $hourEnd): array;
    public function ticketsByClientVehicleRangeHour(Id $idClient, DateTimeFormat $date, int $hourStart,  int $hourEnd, Id $idUser): array;
    public function ticketsByClientFleetVehicleRangeHour(Id $idClient, DateTimeFormat $dateStart, DateTimeFormat $dateEnd, int $hourStart,  int $hourEnd): array;
}
