<?php


namespace Src\TransportePersonal\TipoRuta\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\TipoRuta\Application\AssignPointsUseCase;
use Src\TransportePersonal\TipoRuta\Infraestructure\Repositories\EloquentTipoRutaRepository;

final class AssignPointsController
{

    /**
     * @var EloquentTipoRutaRepository
     */
    private $repository;

    public function __construct( EloquentTipoRutaRepository $repository )
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
