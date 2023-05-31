<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Cold\ColdMachineAlert\Application\CreateUseCase;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;


final class CreateController
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
    public function __invoke(Request $request): ?ColdMachineAlert
    {
        $user = Auth::user();
        $id = Uuid::uuid4();
        $code = $request->input('code');
        $text = $request->input('text');
        $description = $request->input('description');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke(
            $id,
            $code,
            $text,
            $description,
            $user->getId()
        );
    }
}
