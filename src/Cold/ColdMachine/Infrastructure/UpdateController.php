<?php


namespace Src\Cold\ColdMachine\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Cold\ColdMachine\Application\UpdateUseCase;
use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Infrastructure\Repositories\EloquentColdMachineRepository;

final class UpdateController
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
        $id = $request->id;
        $imei = $request->input('imei');
        $idModel = $request->input('idModel');
        $idStatus = $request->input('idStatus');
        $idClient = $request->input('idModel');
        $maxFueld = $request->input('maxFuel');
        $setPoint = $request->input('setPoint');
        $sim = $request->input('sim');
        //$idUserCreated = $request->input('idUser');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke(
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
