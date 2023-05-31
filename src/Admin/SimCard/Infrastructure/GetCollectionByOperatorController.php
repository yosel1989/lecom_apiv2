<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\GetCollectionByOperatorUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class GetCollectionByOperatorController
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
    public function __invoke(Request $request)
    {
        $id = $request->id;
        $getCollectionUseCase = new GetCollectionByOperatorUseCase($this->repository);
        return $getCollectionUseCase->__invoke($id);
    }
}
