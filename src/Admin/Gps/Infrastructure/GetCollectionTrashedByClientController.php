<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\GetCollectionTrashedByClientUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class GetCollectionTrashedByClientController
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
        $getCollectionTrashedByClientUseCase = new GetCollectionTrashedByClientUseCase($this->repository);
        return $getCollectionTrashedByClientUseCase->__invoke($id);
    }
}
