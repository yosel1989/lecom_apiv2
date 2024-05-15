<?php


namespace Src\V2\ClienteMedioPago\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteMedioPago\Application\GetCollectionUseCase;
use Src\V2\ClienteMedioPago\Domain\ClienteMedioPago;
use Src\V2\ClienteMedioPago\Infrastructure\Repositories\EloquentClienteMedioPagoRepository;

final class GetCollectionController
{
    private EloquentClienteMedioPagoRepository $repository;

    public function __construct(EloquentClienteMedioPagoRepository $repository)
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
        $useCase = new GetCollectionUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
