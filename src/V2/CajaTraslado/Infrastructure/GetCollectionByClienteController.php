<?php


namespace Src\V2\CajaTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\CajaTraslado\Application\GetCollectionByClienteUseCase;
use Src\V2\CajaTraslado\Domain\CajaTrasladoList;
use Src\V2\CajaTraslado\Infrastructure\Repositories\EloquentCajaTrasladoRepository;

final class GetCollectionByClienteController
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
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
