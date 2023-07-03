<?php


namespace Src\V2\Personal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\Personal\Application\FindByIdUseCase;
use Src\V2\Personal\Domain\Personal;
use Src\V2\Personal\Infrastructure\Repositories\EloquentPersonalRepository;

final class FindByIdController
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
    public function __invoke( Request $request ): Personal
    {
        $idPersonal = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idPersonal);
    }

}
