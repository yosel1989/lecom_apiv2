<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachine\Application\DeleteUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class DeleteController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
