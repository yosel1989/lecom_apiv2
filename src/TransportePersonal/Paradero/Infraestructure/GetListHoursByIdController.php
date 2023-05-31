<?php

namespace Src\TransportePersonal\Paradero\Infraestructure;

use Illuminate\Http\Request;
use Src\TransportePersonal\Paradero\Application\GetListHoursByIdUseCase;
use Src\TransportePersonal\Paradero\Infraestructure\Repositories\EloquentParaderoRepository;

final class GetListHoursByIdController
{

    /**
     * @var EloquentParaderoRepository
     */
    private $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $caseUse = new GetListHoursByIdUseCase( $this->repository );
        return $caseUse->__invoke(
            $Id
        );
    }
}
