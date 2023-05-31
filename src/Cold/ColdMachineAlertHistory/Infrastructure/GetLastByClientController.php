<?php


namespace Src\Cold\ColdMachineAlertHistory\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlertHistory\Application\GetLastByClientCase;
use Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories\EloquentColdMachineAlertHistoryRepository;

final class GetLastByClientController
{
    private $repository;

    public function __construct(EloquentColdMachineAlertHistoryRepository $repository)
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
        $getLastByClientCase = new GetLastByClientCase($this->repository);
        return $getLastByClientCase->__invoke($idClient);
    }
}
