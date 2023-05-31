<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientCollectionTrashByParentUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class GetClientTrashCollectionByParentController
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
        $idParent = $request->parent;

        $getClientTrashCollectionByParentUseCase = new GetClientCollectionTrashByParentUseCase($this->repository);
        return $getClientTrashCollectionByParentUseCase->__invoke($idParent);
    }
}
