<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientCollectionUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class GetClientCollectionController
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
        $getClientCollectionUseCase = new GetClientCollectionUseCase($this->repository);
        return $getClientCollectionUseCase->__invoke();
    }
}
