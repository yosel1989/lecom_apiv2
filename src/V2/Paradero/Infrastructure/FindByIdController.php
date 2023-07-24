<?php


namespace Src\V2\Paradero\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Paradero\Application\FindByIdUseCase;
use Src\V2\Paradero\Domain\Paradero;
use Src\V2\Paradero\Infrastructure\Repositories\EloquentParaderoRepository;

final class FindByIdController
{
    private EloquentParaderoRepository $repository;

    public function __construct(EloquentParaderoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Paradero
    {
        $idParadero = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idParadero);
    }

}
