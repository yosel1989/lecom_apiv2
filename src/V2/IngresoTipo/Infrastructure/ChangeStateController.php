<?php


namespace Src\V2\IngresoTipo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\IngresoTipo\Application\ChangeStateUseCase;
use Src\V2\IngresoTipo\Infrastructure\Repositories\EloquentIngresoTipoRepository;

final class ChangeStateController
{
    private EloquentIngresoTipoRepository $repository;

    public function __construct(EloquentIngresoTipoRepository $repository)
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
        $idIngresoTipo = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idIngresoTipo,
            $idEstado,
            $user->getId()
        );
    }

}
