<?php


namespace Src\V2\TipoPersonal\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\TipoPersonal\Application\FindByIdUseCase;
use Src\V2\TipoPersonal\Domain\TipoPersonal;
use Src\V2\TipoPersonal\Infrastructure\Repositories\EloquentTipoPersonalRepository;

final class FindByIdController
{
    private EloquentTipoPersonalRepository $repository;

    public function __construct(EloquentTipoPersonalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): TipoPersonal
    {
        $idTipoPersonal = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idTipoPersonal);
    }

}
