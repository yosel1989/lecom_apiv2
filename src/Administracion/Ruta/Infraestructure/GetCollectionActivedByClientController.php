<?php

namespace Src\Administracion\Ruta\Infraestructure;

use Illuminate\Http\Request;
use Src\Administracion\Ruta\Application\GetCollectionActivedByClientUseCase;
use Src\Administracion\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class GetCollectionActivedByClientController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createRutaCase = new GetCollectionActivedByClientUseCase( $this->repository );
        return $createRutaCase->__invoke(
            $Id,
        );
    }

}
