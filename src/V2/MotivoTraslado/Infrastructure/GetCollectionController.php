<?php


namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MotivoTraslado\Application\GetCollectionUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class GetCollectionController
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
    public function __invoke( Request $request ): array
    {
        $useCase = new GetCollectionUseCase($this->repository);
        return $useCase->__invoke();
    }

}
