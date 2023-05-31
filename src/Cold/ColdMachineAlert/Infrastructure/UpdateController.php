<?php


namespace Src\Cold\ColdMachineAlert\Infrastructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Cold\ColdMachineAlert\Application\UpdateUseCase;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Infrastructure\Repositories\EloquentColdMachineAlertRepository;

final class UpdateController
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
        $id = $request->id;
        $code = $request->input('code');
        $text = $request->input('text');
        $description = $request->input('description');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke(
            $id,
            $code,
            $text,
            $description,
            $user->getId()
        );
    }
}
