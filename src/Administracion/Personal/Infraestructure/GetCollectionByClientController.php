<?php


namespace Src\Administracion\Personal\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Personal\Application\GetCollectionByClientUseCase;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;

final class GetCollectionByClientController
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

        $createParaderoCase = new GetCollectionByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id
        );
    }
}
