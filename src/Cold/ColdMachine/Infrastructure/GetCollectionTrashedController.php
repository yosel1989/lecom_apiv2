<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachine\Application\GetCollectionTrashedUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class GetCollectionTrashedController
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
        $getCollectionTrashedUseCase = new GetCollectionTrashedUseCase($this->repository);
        return $getCollectionTrashedUseCase->__invoke();
    }
}
