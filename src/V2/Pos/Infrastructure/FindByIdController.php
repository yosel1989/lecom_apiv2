<?php


namespace Src\V2\Pos\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Pos\Application\FindByIdUseCase;
use Src\V2\Pos\Domain\Pos;
use Src\V2\Pos\Infrastructure\Repositories\EloquentPosRepository;

final class FindByIdController
{
    private EloquentPosRepository $repository;

    public function __construct(EloquentPosRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Pos
    {
        $idPos = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idPos);
    }

}
