<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaTraslado\Application\ChangeStateUseCase;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class ChangeStateController
{
    private EloquentCajaTrasladoRepository $repository;

    public function __construct(EloquentCajaTrasladoRepository $repository)
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
        $idCajaTraslado = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCajaTraslado,
            $idEstado,
            $user->getId()
        );
    }

}
