<?php


namespace Src\V2\Modulo\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Modulo\Application\GetListToUsuarioPerfilUseCase;
use Src\V2\Modulo\Infrastructure\Repositories\EloquentModuloRepository;

final class GetListToUsuarioPerfilController
{
    private EloquentModuloRepository $repository;

    public function __construct(EloquentModuloRepository $repository)
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
