<?php


namespace Src\V2\Egreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Egreso\Application\ChangeStateUseCase;
use Src\V2\Egreso\Infrastructure\Repositories\EloquentEgresoRepository;

final class ChangeStateController
{
    private EloquentEgresoRepository $repository;

    public function __construct(EloquentEgresoRepository $repository)
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
        $idEgreso = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idEgreso,
            $idEstado,
            $user->getId()
        );
    }

}
