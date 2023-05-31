<?php

namespace Src\TransportePersonal\Troncal\Infraestructure;

use Illuminate\Http\Request;
use Src\TransportePersonal\Troncal\Application\GetListPointsByIdUseCase;
use Src\TransportePersonal\Troncal\Infraestructure\Repositories\EloquentTroncalRepository;

final class GetListPointsByIdController
{

    /**
     * @var EloquentTroncalRepository
     */
    private $repository;

    public function __construct( EloquentTroncalRepository $repository )
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
