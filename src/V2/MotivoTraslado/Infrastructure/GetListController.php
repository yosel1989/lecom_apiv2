<?php


namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MotivoTraslado\Application\GetListUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class GetListController
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
        $useCase = new GetListUseCase($this->repository);
        return $useCase->__invoke();
    }

}
