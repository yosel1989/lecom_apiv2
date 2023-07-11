<?php


namespace Src\V2\Destino\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Destino\Application\GetCollectionByClienteUseCase;
use Src\V2\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class GetCollectionByClienteController
{
    private EloquentDestinoRepository $repository;

    public function __construct(EloquentDestinoRepository $repository)
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
        $getVehicleCollectionByClientUseCase = new GetCollectionByClienteUseCase($this->repository);
        return $getVehicleCollectionByClientUseCase->__invoke($idClient);
    }

}
