<?php


namespace Src\V2\Ruta\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Ruta\Application\ChangeStateUseCase;
use Src\V2\Ruta\Infrastructure\Repositories\EloquentRutaRepository;

final class ChangeStateController
{
    private EloquentRutaRepository $repository;

    public function __construct(EloquentRutaRepository $repository)
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
        $idRuta = $request->idRuta;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idRuta,
            $idEstado,
            $user->getId()
        );
    }

}
