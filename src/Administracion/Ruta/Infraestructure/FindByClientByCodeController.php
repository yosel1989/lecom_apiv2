<?php

namespace Src\Administracion\Ruta\Infraestructure;

use Illuminate\Http\Request;
use Src\Administracion\Ruta\Application\FindByClientByCodeUseCase;
use Src\Administracion\Ruta\Domain\RutaShort;
use Src\Administracion\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class FindByClientByCodeController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): ?RutaShort
    {
        $Id       = $request->id;
        $Codigo       = $request->codigo;

        $useCase = new FindByClientByCodeUseCase( $this->repository );
        return $useCase->__invoke(
            $Id,
            $Codigo
        );
    }

}
