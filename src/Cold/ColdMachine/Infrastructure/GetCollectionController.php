<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachine\Application\GetCollectionUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class GetCollectionController
{
    private $repository;

    public function __construct(EloquentColdMachineRepository $repository)
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
