<?php


namespace Src\V2\Perfil\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Perfil\Application\GetCollectionByClienteByNivelUseCase;
use Src\V2\Perfil\Infrastructure\Repositories\EloquentPerfilRepository;

final class GetCollectionByClienteByNivelController
{
    private EloquentPerfilRepository $repository;

    public function __construct(EloquentPerfilRepository $repository)
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
        $idNivelUsuario = $request->idNivelUsuario;
        $useCase = new GetCollectionByClienteByNivelUseCase($this->repository);
        return $useCase->__invoke($idClient, $idNivelUsuario);
    }

}
