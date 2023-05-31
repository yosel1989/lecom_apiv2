<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\GetCollectionByClientUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class GetCollectionByClientController
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
    public function __invoke(Request $request): array
    {
        $id = $request->id;
        $getCollectionByClientUseCase = new GetCollectionByClientUseCase($this->repository);
        return $getCollectionByClientUseCase->__invoke($id);
    }
}
