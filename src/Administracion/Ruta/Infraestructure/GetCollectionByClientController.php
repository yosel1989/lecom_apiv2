<?php

namespace Src\Administracion\Ruta\Infraestructure;

use Illuminate\Http\Request;
use Src\Administracion\Ruta\Application\GetCollectionByClientUseCase;
use Src\Administracion\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class GetCollectionByClientController
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

        $createRutaCase = new GetCollectionByClientUseCase( $this->repository );
        return $createRutaCase->__invoke(
            $Id,
        );
    }

}
