<?php


namespace Src\V2\Serie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\Serie\Application\ChangeStateUseCase;
use Src\V2\Serie\Infrastructure\Repositories\EloquentSerieRepository;

final class ChangeStateController
{
    private EloquentSerieRepository $repository;

    public function __construct(EloquentSerieRepository $repository)
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
        $idSerie = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idSerie,
            $idEstado,
            $user->getId()
        );
    }

}
