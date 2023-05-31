<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Application\TotalByVehicleUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TotalByVehicleController
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
        $start = new DateTimeFormat($request->start . ' 00:00:00');
        $end = new DateTimeFormat($request->end . ' 00:00:00');
        $idVehicle = new Id($request->idVehicle,false,'El id del vehiculo no tiene el formato valido');

        $idUser = new Id(Auth::user()->id,false,'El id del usuario no tiene el formato valido');

        $useCase = new TotalByVehicleUseCase($this->repository);
        return $useCase->__invoke(
            $start,
            $end,
            $idVehicle,
            $idUser
        );
    }
}
