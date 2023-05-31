<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Src\Cold\ColdMachine\Application\GetCollectionByClientUseCase;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class GetCollectionByClientController
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
        $getCollectionByClientUseCase = new GetCollectionByClientUseCase($this->repository);
        return $getCollectionByClientUseCase->__invoke($idClient);
    }
}
