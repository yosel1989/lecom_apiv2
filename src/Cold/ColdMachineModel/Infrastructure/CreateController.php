<?php


namespace Src\Cold\ColdMachineModel\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Cold\ColdMachineModel\Application\CreateUseCase;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Cold\ColdMachineModel\Infrastructure\Repositories\EloquentColdMachineModelRepository;


final class CreateController
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
        $id = Uuid::uuid4();
        $name = $request->input('name');
        $shortname = $request->input('shortName');
        $idType = $request->input('idType');
        $code = $request->input('code');
        //$idUserCreated = $request->input('idUser');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke(
            $id,
            $name,
            $shortname,
            $idType,
            $code,
            $user->getId()
        );
    }
}
