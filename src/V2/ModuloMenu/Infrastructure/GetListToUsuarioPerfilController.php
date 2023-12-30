<?php


namespace Src\V2\ModuloMenu\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ModuloMenu\Application\GetListToUsuarioPerfilUseCase;
use Src\V2\ModuloMenu\Infrastructure\Repositories\EloquentModuloMenuRepository;

final class GetListToUsuarioPerfilController
{
    private EloquentModuloMenuRepository $repository;

    public function __construct(EloquentModuloMenuRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param string $idPerfil
     * @return mixed
     */
    public function __invoke( Request $request, string $idPerfil ): array
    {
        $useCase = new GetListToUsuarioPerfilUseCase($this->repository);
        return $useCase->__invoke($idPerfil);
    }

}
