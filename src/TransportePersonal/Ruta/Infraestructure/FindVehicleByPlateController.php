<?php


namespace Src\TransportePersonal\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransportePersonal\Ruta\Application\FindVehicleByPlateUseCase;
use Src\TransportePersonal\Ruta\Domain\RutaVehiculo;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class FindVehicleByPlateController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): ?RutaVehiculo
    {
        $user = Auth::user();
        $plate       = $request->placa;

        $useCase = new FindVehicleByPlateUseCase( $this->repository );
        return $useCase->__invoke(
            $plate,
        );
    }
}
