<?php

namespace Src\TransportePersonal\Ruta\Infraestructure;

use Illuminate\Http\Request;
use Src\TransportePersonal\Ruta\Application\GetListPointsByIdUseCase;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class GetListPointsByIdController
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

        $caseUse = new GetListPointsByIdUseCase( $this->repository );
        return $caseUse->__invoke(
            $Id
        );
    }
}
