<?php


namespace Src\V2\CronogramaSalida\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CronogramaSalida\Application\GetReporteDespachoByClienteUseCase;
use Src\V2\CronogramaSalida\Domain\CronogramaSalidaList;
use Src\V2\CronogramaSalida\Infrastructure\Repositories\EloquentCronogramaSalidaRepository;

final class GetReporteDespachoByClienteController
{
    private EloquentCronogramaSalidaRepository $repository;

    public function __construct(EloquentCronogramaSalidaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CronogramaSalidaList
    {
        $user = Auth::user();

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReporteDespachoByClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
