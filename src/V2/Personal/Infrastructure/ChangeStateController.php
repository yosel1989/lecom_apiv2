<?php


namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Personal\Application\ChangeStateUseCase;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class ChangeStateController
{
    private EloquentPersonalRepository $repository;

    public function __construct(EloquentPersonalRepository $repository)
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
        $idPersonal = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idPersonal,
            $idEstado,
            $user->getId()
        );
    }

}
