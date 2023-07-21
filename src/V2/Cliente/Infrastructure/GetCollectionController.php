<?php


namespace Src\V2\Cliente\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Cliente\Application\GetCollectionUseCase;
use Src\V2\Cliente\Infrastructure\Repositories\EloquentClienteRepository;

final class GetCollectionController
{
    private EloquentClienteRepository $repository;

    public function __construct(EloquentClienteRepository $repository)
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
