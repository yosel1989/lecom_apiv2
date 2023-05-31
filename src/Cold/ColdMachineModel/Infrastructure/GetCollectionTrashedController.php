<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineModel\Application\GetCollectionTrashedUseCase;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;

final class GetCollectionTrashedController
{
    private $repository;

    public function __construct(EloquentColdMachineModelRepository $repository)
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
