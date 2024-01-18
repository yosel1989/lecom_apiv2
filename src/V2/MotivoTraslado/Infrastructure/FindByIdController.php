<?php


namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MotivoTraslado\Application\FindByIdUseCase;
use Src\V2\MotivoTraslado\Domain\MotivoTraslado;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class FindByIdController
{
    private EloquentMotivoTrasladoRepository $repository;

    public function __construct(EloquentMotivoTrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): MotivoTraslado
    {
        $idMotivoTraslado = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idMotivoTraslado);
    }

}
