<?php

namespace Src\TransportePersonal\TipoRuta\Infraestructure;

use Illuminate\Http\Request;
use Src\TransportePersonal\TipoRuta\Application\GetListPointsByIdUseCase;
use Src\TransportePersonal\TipoRuta\Infraestructure\Repositories\EloquentTipoRutaRepository;

final class GetListPointsByIdController
{

    /**
     * @var EloquentTipoRutaRepository
     */
    private $repository;

    public function __construct( EloquentTipoRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $caseUse = new GetListPointsByIdUseCase( $this->repository );
        return $caseUse->__invoke(
            $Id
        );
    }
}
