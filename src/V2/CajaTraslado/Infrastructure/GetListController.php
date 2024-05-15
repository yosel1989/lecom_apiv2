<?php


namespace Src\V2\TipoDocumento\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoDocumento\Application\GetListUseCase;
use Src\V2\TipoDocumento\Infrastructure\Repositories\EloquentTipoDocumentoRepository;

final class GetListController
{
    private EloquentTipoDocumentoRepository $repository;

    public function __construct(EloquentTipoDocumentoRepository $repository)
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
