<?php


namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Personal\Application\GetListByClienteUseCase;
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
        $useCase = new GetListByClienteUseCase($this->repository);
        return $useCase->__invoke($idClient);
    }

}
