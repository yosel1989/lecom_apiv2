<?php


namespace Src\V2\BoletoPrecio\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoPrecio\Application\ChangeStateUseCase;
use Src\V2\BoletoPrecio\Infrastructure\Repositories\EloquentBoletoPrecioRepository;

final class ChangeStateController
{
    private EloquentBoletoPrecioRepository $repository;

    public function __construct(EloquentBoletoPrecioRepository $repository)
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
        $idBoletoPrecio = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idBoletoPrecio,
            $idEstado,
            $user->getId()
        );
    }

}
