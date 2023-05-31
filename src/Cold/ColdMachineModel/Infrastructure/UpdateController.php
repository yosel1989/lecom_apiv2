<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Cold\ColdMachineModel\Application\UpdateUseCase;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;

final class UpdateController
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
    public function __invoke(Request $request): ?ColdMachineModel
    {
        $user = Auth::user();
        $id = $request->id;
        $name = $request->input('name');
        $shortname = $request->input('shortName');
        $idType = $request->input('idType');
        $code = $request->input('code');
        //$idUserUpdated = $request->input('idUser');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke(
            $id,
            $name,
            $shortname,
            $idType,
            $code,
            $user->getId()
        );
    }
}
