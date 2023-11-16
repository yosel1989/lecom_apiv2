<?php


namespace Src\V2\ClienteConfiguracion\Infrastructure;

use Illuminate\Http\Request;
use Src\V2\ClienteConfiguracion\Application\FindByIdUseCase;
use Src\V2\ClienteConfiguracion\Domain\ClienteConfiguracion;
use Src\V2\ClienteConfiguracion\Infrastructure\Repositories\EloquentClienteConfiguracionRepository;

final class FindByIdController
{
    private EloquentClienteConfiguracionRepository $repository;

    public function __construct(EloquentClienteConfiguracionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke( Request $request ): ClienteConfiguracion
    {
        $idCliente = $request->input('idCliente');
        $useCase = new FindByIdUseCase($this->repository);
        return $useCase->__invoke($idCliente);
    }

}
