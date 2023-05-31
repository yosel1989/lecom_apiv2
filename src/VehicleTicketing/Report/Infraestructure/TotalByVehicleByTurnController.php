<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Application\TotalByVehicleByTurnUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TotalByVehicleByTurnController
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
        $date = new DateTimeFormat($request->date . ' 00:00:00');
        $idVehicle = new Id($request->idVehicle,false,'El id del cliente no tiene el formato valido');

        $useCase = new TotalByVehicleByTurnUseCase($this->repository);
        return $useCase->__invoke(
            $idVehicle,
            $date
        );
    }
}
