<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\VehicleTicketing\Report\Application\TicketsByVehicleRangeHourUseCase;
use Src\VehicleTicketing\Report\Application\TotalByClientByDateUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TicketsByVehicleRangeHourController
{
    private $repository;

    /**
     * GetTicketCollectionByUserOfDateController constructor.
     * @param EloquentTicketReportRepository $repository
     */
    public function __construct( EloquentTicketReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $start = new DateTimeFormat($request->date . ' 00:00:00');
        $idVehicle = new Id($request->idVehicle,false,'El id del vehiculo no tiene el formato valido');
        $hourStart = (int)$request->hourStart;
        $hourEnd = (int)$request->hourEnd;

        $useCase = new TicketsByVehicleRangeHourUseCase($this->repository);
        return $useCase->__invoke(
            $idVehicle,
            $start,
            $hourStart,
            $hourEnd
        );
    }
}
