<?php


namespace Src\Cold\ColdMachineAlertHistory\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlertHistory\Application\CountByClientCase;
use Src\Cold\ColdMachineAlertHistory\Application\GetLastByClientCase;
use Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories\EloquentColdMachineAlertHistoryRepository;

final class CountByClientController
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
    public function __invoke(Request $request): int
    {
        $idClient = $request->idClient;
        $useCase = new CountByClientCase($this->repository);
        return $useCase->__invoke($idClient);
    }
}
