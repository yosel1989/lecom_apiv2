<?php


namespace Src\Cold\ColdMachineAlertHistory\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlertHistory\Application\GetCollectionByClientCase;
use Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories\EloquentColdMachineAlertHistoryRepository;

final class GetCollectionByClientController
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
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $getCollectionUseCase = new GetCollectionByClientCase($this->repository);
        return $getCollectionUseCase->__invoke($idClient,$dateStart,$dateEnd);
    }
}
