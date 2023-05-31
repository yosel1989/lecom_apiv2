<?php


namespace Src\Cold\ColdMachineHistory\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineHistory\Application\GetHistoryLevelFuelUseCase;
use Src\Cold\ColdMachineHistory\Infrastructure\Repositories\EloquentColdMachineHistoryRepository;

final class GetHistoryLevelFuelController
{
    private $repository;

    public function __construct(EloquentColdMachineHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): array
    {
        $dateStart = $request->dateStart;
        $dateEnd = $request->dateEnd;
        $imei = $request->imei;
        $useCase = new GetHistoryLevelFuelUseCase($this->repository);
        return $useCase->__invoke(
            $dateStart,
            $dateEnd,
            $imei
        );
    }
}
