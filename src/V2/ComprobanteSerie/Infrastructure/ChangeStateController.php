<?php


namespace Src\V2\ComprobanteSerie\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\V2\ComprobanteSerie\Application\ChangeStateUseCase;
use Src\V2\ComprobanteSerie\Infrastructure\Repositories\EloquentComprobanteSerieRepository;

final class ChangeStateController
{
    private EloquentComprobanteSerieRepository $repository;

    public function __construct(EloquentComprobanteSerieRepository $repository)
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
        $id = $request->id;
        $idEstado = $request->input('idEstado');
        $useCase = new ChangeStateUseCase($this->repository);
        $useCase->__invoke(
            $id,
            $idEstado,
            $user->getId()
        );
    }

}
