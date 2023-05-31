<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\GetCollectionByClientUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class GetCollectionByClientController
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
        $getCollectionByClientUseCase = new GetCollectionByClientUseCase($this->repository);
        return $getCollectionByClientUseCase->__invoke($id);
    }
}
