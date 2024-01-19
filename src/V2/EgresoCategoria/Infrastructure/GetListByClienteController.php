<?php


namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoCategoria\Application\GetListByClienteUseCase;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaShortList;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class GetListByClienteController
{
    private EloquentEgresoCategoriaRepository $repository;

    public function __construct(EloquentEgresoCategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): EgresoCategoriaShortList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetListByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
