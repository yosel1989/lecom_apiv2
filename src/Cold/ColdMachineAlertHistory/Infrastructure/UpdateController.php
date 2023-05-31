<?php


namespace Src\Cold\ColdMachineAlertHistory\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Cold\ColdMachineAlertHistory\Application\UpdateUseCase;
use Src\Cold\ColdMachineAlertHistory\Infrastructure\Repositories\EloquentColdMachineAlertHistoryRepository;

final class UpdateController
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
    public function __invoke(Request $request): void
    {
        $user = Auth::user();
        $id = $request->id;

        $getCollectionUseCase = new UpdateUseCase($this->repository);
        $getCollectionUseCase->__invoke(
            $id,
            $user->getId()
        );
    }
}
