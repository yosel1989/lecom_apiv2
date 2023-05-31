<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientCollectionByParentUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class GetClientCollectionByParentController
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

        $getClientCollectionByParentUseCase = new GetClientCollectionByParentUseCase($this->repository);
        return $getClientCollectionByParentUseCase->__invoke($idParent);
    }
}
