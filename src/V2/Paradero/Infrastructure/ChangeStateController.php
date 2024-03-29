<?php


namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Paradero\Application\ChangeStateUseCase;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class ChangeStateController
{
    private EloquentParaderoRepository $repository;

    public function __construct(EloquentParaderoRepository $repository)
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
        $idParadero = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idParadero,
            $idEstado,
            $user->getId()
        );
    }

}
