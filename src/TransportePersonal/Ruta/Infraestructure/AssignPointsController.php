<?php


namespace Src\TransportePersonal\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Ruta\Application\AssignPointsUseCase;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class AssignPointsController
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
        $points      = $request->input('paraderos');

        $useCase = new AssignPointsUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $points
        );
    }
}
