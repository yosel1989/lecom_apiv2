<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineAlert\Application\DeleteUseCase;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
