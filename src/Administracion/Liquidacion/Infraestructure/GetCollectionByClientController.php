<?php


namespace Src\Administracion\Liquidacion\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\Liquidacion\Application\GetCollectionByClientUseCase;
use Src\Administracion\Liquidacion\Infraestructure\Repositories\EloquentLiquidacionRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentLiquidacionRepository
     */
    private $repository;

    public function __construct( EloquentLiquidacionRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createParaderoCase = new GetCollectionByClientUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id
        );
    }
}
