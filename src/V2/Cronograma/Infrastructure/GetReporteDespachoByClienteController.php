<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cronograma\Application\GetReporteDespachoByClienteUseCase;
use Src\V2\Cronograma\Domain\CronogramaList;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class GetReporteDespachoByClienteController
{
    private EloquentCronogramaRepository $repository;

    public function __construct(EloquentCronogramaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): CronogramaList
    {
        $user = Auth::user();

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReporteDespachoByClienteUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
