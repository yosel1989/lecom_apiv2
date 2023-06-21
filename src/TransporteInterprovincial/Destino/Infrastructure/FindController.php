<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;


use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\FindUseCase;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class FindController
{
    private EloquentDestinoRepository $repository;

    /**
     * @param EloquentDestinoRepository $repository
     */
    public function __construct(EloquentDestinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?Destino
    {
        $id = $request->id;
        $useCase = new FindUseCase($this->repository);
        return $useCase->__invoke(
            $id,
        );
    }
}
