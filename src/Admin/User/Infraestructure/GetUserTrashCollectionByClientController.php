<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\GetUserCollectionTrashByClientUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class GetUserTrashCollectionByClientController
{
    private $repository;


    /**
     * GetUserCollectionByUserOfDateController constructor.
     * @param EloquentUserRepository $repository
     */
    public function __construct( EloquentUserRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $idClient = $request->client;

        $getUserCollectionTrashByClientUseCase = new GetUserCollectionTrashByClientUseCase($this->repository);
        return $getUserCollectionTrashByClientUseCase->__invoke($idClient);
    }
}
