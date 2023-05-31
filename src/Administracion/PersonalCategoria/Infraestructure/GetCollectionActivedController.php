<?php

namespace Src\Administracion\PersonalCategoria\Infraestructure;

use Illuminate\Http\Request;
use Src\Administracion\PersonalCategoria\Application\GetCollectionActivedUseCase;
use Src\Administracion\PersonalCategoria\Infraestructure\Repositories\EloquentPersonalCategoriaRepository;

final class GetCollectionActivedController
{

    /**
     * @var EloquentPersonalCategoriaRepository
     */
    private $repository;

    public function __construct( EloquentPersonalCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $caseUse = new GetCollectionActivedUseCase( $this->repository );
        return $caseUse->__invoke();
    }
}
