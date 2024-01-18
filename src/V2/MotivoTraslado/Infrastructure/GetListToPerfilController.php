<?php


namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MotivoTraslado\Application\GetListToPerfilUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class GetListToPerfilController
{
    private EloquentMotivoTrasladoRepository $repository;

    public function __construct(EloquentMotivoTrasladoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param string $idPerfil
     * @return mixed
     */
    public function __invoke( Request $request, string $idPerfil ): array
    {
        $useCase = new GetListToPerfilUseCase($this->repository);
        return $useCase->__invoke($idPerfil);
    }

}
