<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Application\TicketsByClientRangeHourUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TicketsByClientRangeHourController
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
        $idClient = new Id($request->idClient,false,'El id del cliente no tiene el formato valido');
        $hourStart = (int)$request->hourStart;
        $hourEnd = (int)$request->hourEnd;

        $idUser = new Id(Auth::user()->id,false,'El id del usuario no tiene el formato valido');

        $useCase = new TicketsByClientRangeHourUseCase($this->repository);
        return $useCase->__invoke(
            $idClient,
            $start,
            $hourStart,
            $hourEnd,
            $idUser
        );
    }
}
