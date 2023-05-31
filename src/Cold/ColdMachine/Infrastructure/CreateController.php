<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Cold\ColdMachine\Application\CreateUseCase;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class CreateController
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
    public function __invoke(Request $request): ?ColdMachine
    {
        $user = Auth::user();
        $id = Uuid::uuid4();
        $imei = $request->input('imei');
        $idModel = $request->input('idModel');
        $idStatus = $request->input('idStatus');
        $idClient = $request->input('idClient');
        $maxFueld = $request->input('maxFuel');
        $setPoint = $request->input('setPoint');
        $sim = $request->input('sim');
        //$idUserCreated = $request->input('idUser');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke(
            $id,
            $imei,
            $idModel,
            $idStatus,
            $setPoint,
            $idClient,
            $maxFueld,
            $sim,
            $user->getId()
        );
    }
}
