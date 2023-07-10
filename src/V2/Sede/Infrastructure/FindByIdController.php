<?php


namespace Src\V2\Sede\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Sede\Application\FindByIdUseCase;
use Src\V2\Sede\Domain\Sede;
use Src\V2\Sede\Infrastructure\Repositories\EloquentSedeRepository;

final class FindByIdController
{
    private EloquentSedeRepository $repository;

    public function __construct(EloquentSedeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): Sede
    {
        $idSede = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idSede);
    }

}
