<?php


namespace Src\Administracion\Egreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Egreso\Application\GetCollectionByClientUseCase;
use Src\Administracion\Egreso\Infraestructure\Repositories\EloquentEgresoRepository;

final class GetCollectionByClientController
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

        $createParaderoCase = new GetCollectionByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id
        );
    }
}
