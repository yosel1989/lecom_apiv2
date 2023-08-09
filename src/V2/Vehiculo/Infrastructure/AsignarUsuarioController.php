<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Vehiculo\Application\AsignarUsuarioUseCase;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class AsignarUsuarioController
{
    private EloquentVehiculoRepository $repository;

    public function __construct(EloquentVehiculoRepository $repository)
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
        $idUsuario = $request->id;
        $vehiculos = $request->input('vehiculos');
        $useCase = new AsignarUsuarioUseCase($this->repository);
        $useCase->__invoke($idUsuario, $vehiculos, $user->getId());
    }

}
