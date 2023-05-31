<?php


namespace Src\TransportePersonal\Paradero\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Paradero\Application\AssignHoursUseCase;
use Src\TransportePersonal\Paradero\Infraestructure\Repositories\EloquentParaderoRepository;

final class AssignHoursController
{

    /**
     * @var EloquentParaderoRepository
     */
    private $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $Id       = $request->id;
        $hours      = $request->input('horarios');

        $useCase = new AssignHoursUseCase( $this->repository );
        $useCase->__invoke(
            $Id,
            $hours
        );
    }
}
