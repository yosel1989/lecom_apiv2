<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineModel\Application\GetCollectionUseCase;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;

final class GetCollectionController
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
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
