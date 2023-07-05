<?php


namespace Src\V2\Usuario\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Usuario\Application\ChangePasswordUseCase;
use Src\V2\Usuario\Infrastructure\Repositories\EloquentUsuarioRepository;

final class ChangePasswordController
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
    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $idUsuario = $request->id;
        $clave = $request->input('clave');
        $useCase = new ChangePasswordUseCase($this->repository);
        $useCase->__invoke(
            $idUsuario,
            $clave,
            $user->getId()
        );
    }

}
