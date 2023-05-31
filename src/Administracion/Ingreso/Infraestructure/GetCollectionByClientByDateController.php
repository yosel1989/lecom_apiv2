<?php


namespace Src\Administracion\Ingreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Ingreso\Application\GetCollectionByClientByDateUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class GetCollectionByClientByDateController
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
        $Id       = $request->id;
        $fecha       = $request->fecha;

        $createParaderoCase = new GetCollectionByClientByDateUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
            $fecha
        );
    }
}
