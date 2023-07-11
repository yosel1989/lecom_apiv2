<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\BoletoInterprovincial\Application\ChangeStateUseCase;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class ChangeStateController
{
    private EloquentBoletoInterprovincialRepository $repository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository)
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
        $idBoletoInterprovincial = $request->idBoletoInterprovincial;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $idBoletoInterprovincial,
            $idEstado,
            $user->getId()
        );
    }

}
