<?php


namespace Src\V2\Destino\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Destino\Application\ChangeStateUseCase;
use Src\V2\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class ChangeStateController
{
    private EloquentDestinoRepository $repository;

    public function __construct(EloquentDestinoRepository $repository)
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
        $idDestino = $request->idDestino;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idDestino,
            $idEstado,
            $user->getId()
        );
    }

}
