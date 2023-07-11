<?php


namespace Src\V2\BoletoInterprovincial\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\BoletoInterprovincial\Application\FindByIdUseCase;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincial;
use Src\V2\BoletoInterprovincial\Infrastructure\Repositories\EloquentBoletoInterprovincialRepository;

final class FindByIdController
{
    private EloquentBoletoInterprovincialRepository $repository;

    public function __construct(EloquentBoletoInterprovincialRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): BoletoInterprovincial
    {
        $idBoletoInterprovincial = $request->id;
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idBoletoInterprovincial);
    }

}
