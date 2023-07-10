<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Caja\Application\ChangeStateUseCase;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class ChangeStateController
{
    private EloquentCajaRepository $repository;

    public function __construct(EloquentCajaRepository $repository)
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
        $idCaja = $request->idCaja;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCaja,
            $idEstado,
            $user->getId()
        );
    }

}
