<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\GetUserCollectionByClientUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class GetUserCollectionByClientController
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
        $idClient = $request->id;

        $getUserCollectionByClientUseCase = new GetUserCollectionByClientUseCase($this->repository);
        return $getUserCollectionByClientUseCase->__invoke($idClient);
    }
}
