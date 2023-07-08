<?php


namespace Src\V2\Perfil\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Perfil\Application\FindByIdUseCase;
use Src\V2\Perfil\Domain\Perfil;
use Src\V2\Perfil\Infrastructure\Repositories\EloquentPerfilRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Perfil
    {
        $idPerfil = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idPerfil);
    }

}
