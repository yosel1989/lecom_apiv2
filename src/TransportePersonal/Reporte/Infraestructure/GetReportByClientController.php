<?php


namespace Src\TransportePersonal\Reporte\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Reporte\Application\GetReportByClientUseCase;
use Src\TransportePersonal\Reporte\Infraestructure\Repositories\EloquentReporteRepository;

final class GetReportByClientController
{

    /**
     * @var EloquentReporteRepository
     */
    private $repository;

    public function __construct( EloquentReporteRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;
        $FechaDesde = $request->fechaDesde;
        $FechaHasta = $request->fechaHasta;

        $createReporteCase = new GetReportByClientUseCase( $this->repository );
        return $createReporteCase->__invoke(
            $Id,
            $FechaDesde,
            $FechaHasta
        );
    }
}
