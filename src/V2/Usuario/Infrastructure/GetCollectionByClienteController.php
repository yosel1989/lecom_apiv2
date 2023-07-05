<?php


namespace Src\V2\Usuario\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Usuario\Application\GetCollectionByClienteUseCase;
use Src\V2\Usuario\Infrastructure\Repositories\EloquentUsuarioRepository;

final class GetCollectionByClienteController
{
    private EloquentUsuarioRepository $repository;

    public function __construct(EloquentUsuarioRepository $repository)
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
