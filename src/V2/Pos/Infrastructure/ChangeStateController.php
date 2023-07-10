<?php


namespace Src\V2\Pos\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Pos\Application\ChangeStateUseCase;
use Src\V2\Pos\Infrastructure\Repositories\EloquentPosRepository;

final class ChangeStateController
{
    private EloquentPosRepository $repository;

    public function __construct(EloquentPosRepository $repository)
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
        $idPos = $request->idPos;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idPos,
            $idEstado,
            $user->getId()
        );
    }

}
