<?php


namespace Src\Administracion\Ingreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Ingreso\Application\GetCollectionByClientUseCase;
use Src\Administracion\Ingreso\Infraestructure\Repositories\EloquentIngresoRepository;

final class GetCollectionByClientController
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

        $createParaderoCase = new GetCollectionByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id
        );
    }
}
