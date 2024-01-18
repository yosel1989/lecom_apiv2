<?php


namespace Src\V2\Vehiculo\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Vehiculo\Application\GetListByUsuarioUseCase;
use Src\V2\Vehiculo\Domain\VehiculoShortList;
use Src\V2\Vehiculo\Infrastructure\Repositories\EloquentVehiculoRepository;

final class GetListByUsuarioActualController
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
    public function __invoke( Request $request ): VehiculoShortList
    {
        $user = Auth::user();
        $useCase = new GetListByUsuarioUseCase($this->repository);
        return $useCase->__invoke($user->getId(), $user->getIdCliente());
    }

}
