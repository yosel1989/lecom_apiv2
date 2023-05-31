<?php


namespace Src\Administracion\TipoIngreso\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\TipoIngreso\Application\GetListByClientUseCase;
use Src\Administracion\TipoIngreso\Infraestructure\Repositories\EloquentTipoIngresoRepository;

final class GetListByClientController
{

    /**
     * @var EloquentTipoIngresoRepository
     */
    private $repository;

    public function __construct( EloquentTipoIngresoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createParaderoCase = new GetListByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id
        );
    }
}
