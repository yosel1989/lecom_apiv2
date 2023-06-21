<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;

use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\GetCollectionByClientUseCase;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class GetCollectionByClientController
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
        $useCase = new GetCollectionByClientUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
