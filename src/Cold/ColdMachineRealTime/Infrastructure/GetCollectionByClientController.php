<?php


namespace Src\Cold\ColdMachineRealTime\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineRealTime\Application\GetCollectionByClientCase;
use Src\Cold\ColdMachineRealTime\Infrastructure\Repositories\EloquentColdMachineRealTimeRepository;

final class GetCollectionByClientController
{
    private $repository;

    public function __construct(EloquentColdMachineRealTimeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $idClient = $request->idClient;
        $getCollectionByClientUseCase = new GetCollectionByClientCase($this->repository);
        return $getCollectionByClientUseCase->__invoke($idClient);
    }
}
