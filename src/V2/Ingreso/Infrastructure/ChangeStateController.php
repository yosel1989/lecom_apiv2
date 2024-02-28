<?php


namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Ingreso\Application\ChangeStateUseCase;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;

final class ChangeStateController
{
    private EloquentIngresoRepository $repository;

    public function __construct(EloquentIngresoRepository $repository)
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
        $idIngreso = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idIngreso,
            $idEstado,
            $user->getId()
        );
    }

}
