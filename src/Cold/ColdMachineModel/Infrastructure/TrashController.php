<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachineModel\Application\TrashUseCase;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;

final class TrashController
{
    private $repository;

    public function __construct(EloquentColdMachineModelRepository $repository)
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
