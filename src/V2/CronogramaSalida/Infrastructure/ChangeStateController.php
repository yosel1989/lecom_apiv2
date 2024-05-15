<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CronogramaSalida\Application\ChangeStateUseCase;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class ChangeStateController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(EloquentCronogramaSalidaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idCronogramaSalida = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCronogramaSalida,
            $idEstado,
            $user->getId()
        );
    }

}
