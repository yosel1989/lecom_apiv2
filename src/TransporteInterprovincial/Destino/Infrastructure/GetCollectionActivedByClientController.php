<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;

use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\GetCollectionActivedByClientUseCase;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class GetCollectionActivedByClientController
{
    private $repository;

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
        $getDestinoCollectionByClientUseCase = new GetCollectionActivedByClientUseCase($this->repository);
        return $getDestinoCollectionByClientUseCase->__invoke($idClient);
    }

}
