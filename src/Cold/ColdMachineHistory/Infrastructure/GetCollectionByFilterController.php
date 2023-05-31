<?php


namespace Src\Cold\ColdMachineHistory\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineHistory\Application\GetCollectionByFilterUseCase;
use Src\Cold\ColdMachineHistory\Infrastructure\Repositories\EloquentColdMachineHistoryRepository;

final class GetCollectionByFilterController
{
    private $repository;

    public function __construct(EloquentColdMachineHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getCollectionUseCase = new GetCollectionByFilterUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
