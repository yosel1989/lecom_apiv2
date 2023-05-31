<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\GetCollectionTrashedByClientUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class GetCollectionTrashedByClientController
{
    private $repository;

    public function __construct(EloquentSimCardRepository $repository)
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
