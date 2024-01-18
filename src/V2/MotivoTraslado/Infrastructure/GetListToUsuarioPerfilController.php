<?php


namespace Src\V2\MotivoTraslado\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\MotivoTraslado\Application\GetListToUsuarioPerfilUseCase;
use Src\V2\MotivoTraslado\Infrastructure\Repositories\EloquentMotivoTrasladoRepository;

final class GetListToUsuarioPerfilController
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
        $useCase = new GetListToUsuarioPerfilUseCase($this->repository);
        return $useCase->__invoke($idPerfil);
    }

}
