<?php


namespace Src\Administracion\Egreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Egreso\Application\GetReportByClientUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class GetReportByClientController
{

    /**
     * @var EloquentEgresoRepository
     */
    private $repository;

    public function __construct( EloquentEgresoRepository $repository )
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
