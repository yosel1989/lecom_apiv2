<?php


namespace Src\V2\EgresoCategoria\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\EgresoCategoria\Application\GetCollectionByClienteUseCase;
use Src\V2\EgresoCategoria\Domain\EgresoCategoriaList;
use Src\V2\EgresoCategoria\Infrastructure\Repositories\EloquentEgresoCategoriaRepository;

final class GetCollectionByClienteController
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
    public function __invoke( Request $request ): EgresoCategoriaList
    {
        $idClient = $request->id;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
