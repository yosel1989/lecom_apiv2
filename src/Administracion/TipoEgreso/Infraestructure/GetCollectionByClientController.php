<?php


namespace Src\Administracion\TipoEgreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\TipoEgreso\Application\GetCollectionByClientUseCase;
use Src\Administracion\TipoEgreso\Infraestructure\Repositories\EloquentTipoEgresoRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentTipoEgresoRepository
     */
    private $repository;

    public function __construct( EloquentTipoEgresoRepository $repository )
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
