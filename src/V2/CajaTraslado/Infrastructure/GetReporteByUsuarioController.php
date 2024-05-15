<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\CajaTraslado\Application\GetReporteByUsuarioUseCase;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class GetReporteByUsuarioController
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
    public function __invoke( Request $request ): CajaTrasladoList
    {
        $user = Auth::user();

        $idCliente = $request->id;
        $fecha = (new \DateTime('now'))->format('Y-m-d');
        $useCase = new GetReporteByUsuarioUseCase($this->repository);
        return $useCase->__invoke($idCliente, $user->getId(), $fecha);
    }

}
