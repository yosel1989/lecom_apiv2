<?php


namespace Src\TransportePersonal\TipoRuta\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\TipoRuta\Application\GetCollectionByClientUseCase;
use Src\TransportePersonal\TipoRuta\Infraestructure\Repositories\EloquentTipoRutaRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentTipoRutaRepository
     */
    private $repository;

    public function __construct( EloquentTipoRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createTipoRutaCase = new GetCollectionByClientUseCase( $this->repository );
        return $createTipoRutaCase->__invoke(
            $Id,
        );
    }
}
