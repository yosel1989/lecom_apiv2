<?php


namespace Src\V2\RutaSede\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\RutaSede\Application\GetCollectionByClienteRutaUseCase;
use Src\V2\RutaSede\Infrastructure\Repositories\EloquentRutaSedeRepository;

final class GetCollectionByClientePerfilController
{
    private EloquentRutaSedeRepository $repository;

    public function __construct(EloquentRutaSedeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $idRuta = $request->idRuta;
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteRutaUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient, $idRuta);
    }

}
