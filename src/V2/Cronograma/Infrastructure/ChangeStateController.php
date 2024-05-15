<?php


namespace Src\V2\Cronograma\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Cronograma\Application\ChangeStateUseCase;
use Src\V2\Cronograma\Infrastructure\Repositories\EloquentCronogramaRepository;

final class ChangeStateController
{
    private EloquentCronogramaRepository $repository;

    public function __construct(EloquentCronogramaRepository $repository)
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
        $idCronograma = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idCronograma,
            $idEstado,
            $user->getId()
        );
    }

}
