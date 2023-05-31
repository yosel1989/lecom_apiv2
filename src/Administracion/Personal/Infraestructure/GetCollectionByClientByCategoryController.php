<?php

namespace Src\Administracion\Personal\Infraestructure;

use Illuminate\Http\Request;
use Src\Administracion\Personal\Application\GetCollectionByClientByCategoryUseCase;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;

final class GetCollectionByClientByCategoryController
{

    /**
     * @var EloquentPersonalRepository
     */
    private $repository;

    public function __construct( EloquentPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;
        $Code       = (int)$request->code;

        $createParaderoCase = new GetCollectionByClientByCategoryUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
            $Code
        );
    }
}
