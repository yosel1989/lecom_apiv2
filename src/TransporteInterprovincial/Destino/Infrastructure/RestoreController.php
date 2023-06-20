<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;

use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\RestoreUseCase;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentDestinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreUseCase = new RestoreUseCase($this->repository);
        $restoreUseCase->__invoke( $id );
    }
}
