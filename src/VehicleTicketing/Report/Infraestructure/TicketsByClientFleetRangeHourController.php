<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Application\TicketsByClientFleetRangeHourUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TicketsByClientFleetRangeHourController
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
        $dateStart = new DateTimeFormat($request->dateStart . ' 00:00:00');
        $dateEnd = new DateTimeFormat($request->dateEnd . ' 00:00:00');
        $idClient = new Id($request->idClient,false,'El id del cliente no tiene el formato valido');
        $hourStart = (int)$request->hourStart;
        $hourEnd = (int)$request->hourEnd;

        $useCase = new TicketsByClientFLeetRangeHourUseCase($this->repository);
        return $useCase->__invoke(
            $idClient,
            $dateStart,
            $dateEnd,
            $hourStart,
            $hourEnd
        );
    }
}
