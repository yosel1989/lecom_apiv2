<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Illuminate\Http\Request;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\VehicleTicketing\Report\Application\TotalAverageByFleetHourUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TotalAverageByFleetHourController
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
        $dateS = new DateTimeFormat($request->dateStart . ' 00:00:00');
        $dateE = new DateTimeFormat($request->dateEnd . ' 00:00:00');
        $idClient = new Id($request->idClient,false,'El id del cliente no tiene el formato valido');

        $useCase = new TotalAverageByFleetHourUseCase($this->repository);
        return $useCase->__invoke(
            $dateS,
            $dateE,
            $idClient
        );
    }
}
