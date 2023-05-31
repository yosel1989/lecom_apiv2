<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\GetCollectionTrashedUseCase;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class GetCollectionTrashedController
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
        $getCollectionTrashedUseCase = new GetCollectionTrashedUseCase($this->repository);
        return $getCollectionTrashedUseCase->__invoke();
    }
}
