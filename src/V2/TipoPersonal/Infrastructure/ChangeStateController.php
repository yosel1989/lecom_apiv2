<?php


namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\TipoPersonal\Application\ChangeStateUseCase;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class ChangeStateController
{
    private EloquentTipoPersonalRepository $repository;

    public function __construct(EloquentTipoPersonalRepository $repository)
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
        $idTipoPersonal = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idTipoPersonal,
            $idEstado,
            $user->getId()
        );
    }

}
