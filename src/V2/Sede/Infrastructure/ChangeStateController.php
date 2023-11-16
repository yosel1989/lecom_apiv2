<?php


namespace Src\V2\Sede\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Sede\Application\ChangeStateUseCase;
use Src\V2\Sede\Infrastructure\Repositories\EloquentSedeRepository;

final class ChangeStateController
{
    private EloquentSedeRepository $repository;

    public function __construct(EloquentSedeRepository $repository)
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
        $idSede = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idSede,
            $idEstado,
            $user->getId()
        );
    }

}
