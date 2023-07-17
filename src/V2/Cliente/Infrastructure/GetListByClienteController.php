<?php


namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cliente\Application\GetCollectionByClienteUseCase;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class GetListByClienteController
{
    private EloquentClienteRepository $repository;

    public function __construct(EloquentClienteRepository $repository)
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
        $useCase = new GetCollectionByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
