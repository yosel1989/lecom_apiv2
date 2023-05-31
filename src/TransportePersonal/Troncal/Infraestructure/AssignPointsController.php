<?php


namespace Src\TransportePersonal\Troncal\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Troncal\Application\AssignPointsUseCase;
use Src\TransportePersonal\Troncal\Infraestructure\Repositories\EloquentTroncalRepository;

final class AssignPointsController
{

    /**
     * @var EloquentTroncalRepository
     */
    private $repository;

    public function __construct( EloquentTroncalRepository $repository )
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
