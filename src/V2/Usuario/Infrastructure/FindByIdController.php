<?php


namespace Src\V2\Usuario\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Usuario\Application\FindByIdUseCase;
use Src\V2\Usuario\Domain\Usuario;
use Src\V2\Usuario\Infrastructure\Repositories\EloquentUsuarioRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Usuario
    {
        $idUsuario = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idUsuario);
    }

}
