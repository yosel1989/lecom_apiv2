<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\GetVehicleCollectionByUserUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class GetVehicleCollectionByUserController
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
        $idUser = $request->id;

        $getUserCollectionByClientUseCase = new GetVehicleCollectionByUserUseCase($this->repository);
        return $getUserCollectionByClientUseCase->__invoke($idUser);
    }
}
