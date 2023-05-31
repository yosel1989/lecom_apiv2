<?php


namespace Src\TransportePersonal\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Ruta\Application\AssignVehiclesUseCase;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class AssignVehiclesController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $Id       = $request->id;
        $points      = $request->input('vehiculos');

        $useCase = new AssignVehiclesUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $points
        );
    }
}
