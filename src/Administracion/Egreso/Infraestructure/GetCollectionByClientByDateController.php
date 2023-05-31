<?php


namespace Src\Administracion\Egreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Egreso\Application\GetCollectionByClientByDateUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class GetCollectionByClientByDateController
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
        $Id       = $request->id;
        $fecha       = $request->fecha;

        $createParaderoCase = new GetCollectionByClientByDateUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
            $fecha
        );
    }
}
