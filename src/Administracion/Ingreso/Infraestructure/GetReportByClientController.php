<?php


namespace Src\Administracion\Ingreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Ingreso\Application\GetReportByClientUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class GetReportByClientController
{

    /**
     * @var EloquentIngresoRepository
     */
    private $repository;

    public function __construct( EloquentIngresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $FechaDesde       = $request->fechaDesde;
        $FechaHasta       = $request->fechaHasta;
        $IdVehiculo       = $request->idVehiculo;
        $IdCliente       = $request->id;

        $createParaderoCase = new GetReportByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $FechaDesde,
            $FechaHasta,
            $IdVehiculo,
            $IdCliente
        );
    }
}
