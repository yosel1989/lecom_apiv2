<?php


namespace Src\Administracion\TipoIngreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\TipoIngreso\Application\GetCollectionByClientUseCase;
use Src\Administracion\TipoIngreso\Infraestructure\Repositories\EloquentTipoIngresoRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentTipoIngresoRepository
     */
    private $repository;

    public function __construct( EloquentTipoIngresoRepository $repository )
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
