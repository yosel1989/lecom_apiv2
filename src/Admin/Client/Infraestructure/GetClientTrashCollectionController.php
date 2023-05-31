<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientCollectionTrashUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class GetClientTrashCollectionController
{
    private $repository;


    /**
     * GetClientCollectionByUserOfDateController constructor.
     * @param EloquentClientRepository $repository
     */
    public function __construct( EloquentClientRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $getClientCollectionTrashUseCase = new GetClientCollectionTrashUseCase($this->repository);
        return $getClientCollectionTrashUseCase->__invoke();
    }
}
