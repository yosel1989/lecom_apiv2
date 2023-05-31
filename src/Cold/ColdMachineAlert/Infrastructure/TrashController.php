<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlert\Application\TrashUseCase;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;

final class TrashController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
