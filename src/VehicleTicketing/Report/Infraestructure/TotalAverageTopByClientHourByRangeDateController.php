<?php


namespace Src\VehicleTicketing\Report\Infraestructure;


use Faker\Provider\ar_JO\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\VehicleTicketing\Report\Application\TotalAverageByClientHourByRangeDateUseCase;
use Src\VehicleTicketing\Report\Application\TotalAverageTopByClientHourByRangeDateUseCase;
use Src\VehicleTicketing\Report\Infraestructure\Repositories\EloquentTicketReportRepository;

final class TotalAverageTopByClientHourByRangeDateController
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
        $hourStart = new Numeric((int)$request->hourStart);
        $hourEnd = new Numeric((int)$request->hourEnd );
        $idClient = new Id($request->idClient,false,'El id del cliente no tiene el formato valido');

        $idUser = new Id(Auth::user()->id,false,'El id del usuario no tiene el formato valido');

        $useCase = new TotalAverageTopByClientHourByRangeDateUseCase($this->repository);
        return $useCase->__invoke(
            $idClient,
            $dateStart,
            $dateEnd,
            $hourStart,
            $hourEnd,
            $idUser
        );
    }
}
