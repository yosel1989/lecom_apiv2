<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\GetCollectionUseCase;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class GetCollectionController
{
    private $repository;

    public function __construct(EloquentGpsModelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
