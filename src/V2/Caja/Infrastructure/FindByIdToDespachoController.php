<?php


namespace Src\V2\Caja\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Caja\Application\FindByIdToDespachoUseCase;
use Src\V2\Caja\Domain\Caja;
use Src\V2\Caja\Domain\CajaSede;
use Src\V2\Caja\Infrastructure\Repositories\EloquentCajaRepository;

final class FindByIdToDespachoController
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
        $useCase = new FindByIdToDespachoUseCase($this->repository);
        return $useCase->__invoke($idCaja,$idCajaDiario);
    }

}
