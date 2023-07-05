<?php


namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Personal\Application\GetCollectionByClienteUseCase;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class GetListByClienteController
{
    private EloquentPersonalRepository $repository;

    public function __construct(EloquentPersonalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): array
    {
        $idClient = $request->id;
        $useCase = new GetCollectionByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
