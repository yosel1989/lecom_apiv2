<?php


namespace Src\V2\Ingreso\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Ingreso\Application\GetReporteDespachoByClienteUseCase;
use Src\V2\Ingreso\Domain\IngresoList;
use Src\V2\Ingreso\Infrastructure\Repositories\EloquentIngresoRepository;

final class GetReporteDespachoByClienteController
{
    private EloquentIngresoRepository $repository;

    public function __construct(EloquentIngresoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): IngresoList
    {
        $user = Auth::user();

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReporteDespachoByClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
