<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\FindByIdToPuntoVentaUseCase;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class FindByIdToPuntoVentaController
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
    public function __invoke( Request $request ): CajaSede
    {
        $idCaja = $request->id;
        $idCajaDiario = $request->idCajaDiario;
        $useCase = new FindByIdToPuntoVentaUseCase($this->repository);
        return $useCase->__invoke($idCaja,$idCajaDiario);
    }

}
