<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlert\Application\GetCollectionUseCase;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;

final class GetCollectionController
{
    private $repository;

    public function __construct(EloquentColdMachineAlertRepository $repository)
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
