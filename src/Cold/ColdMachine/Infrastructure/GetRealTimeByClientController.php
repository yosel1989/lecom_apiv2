<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachine\Application\GetRealTimeByClientUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class GetRealTimeByClientController
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
        $idClient = $request->idClient;
        $getRealTimeByClientController = new GetRealTimeByClientUseCase($this->repository);
        return $getRealTimeByClientController->__invoke($idClient);
    }
}
