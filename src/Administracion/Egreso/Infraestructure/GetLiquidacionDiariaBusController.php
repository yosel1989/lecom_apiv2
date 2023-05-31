<?php


namespace Src\Administracion\Egreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Egreso\Application\GetLiquidacionDiariaBusUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class GetLiquidacionDiariaBusController
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
        $IdCliente       = $request->idCliente;
        $Fecha       = $request->fecha;
        $IdVehiculo       = $request->idVehiculo;

        $useCase = new GetLiquidacionDiariaBusUseCase( $this->repository );
        return $useCase->__invoke(
            $IdCliente,
            $Fecha,
            $IdVehiculo
        );
    }
}
