<?php


namespace Src\Admin\Ert\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Ert\Application\GetCollectionByClientUseCase;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class GetCollectionByClientController
{
    private $repository;

    public function __construct(EloquentErtRepository $repository)
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
        $getErtCollectionByClientUseCase = new GetCollectionByClientUseCase($this->repository);
        return $getErtCollectionByClientUseCase->__invoke($idClient);
    }

}
