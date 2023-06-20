<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;


use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\TrashUseCase;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
