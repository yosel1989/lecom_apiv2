<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\GetCollectionUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class GetCollectionController
{
    private $repository;

    public function __construct(EloquentGpsRepository $repository)
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
