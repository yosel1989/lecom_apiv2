<?php


namespace Src\TransportePersonal\Ruta\Infraestructure;


use Illuminate\Http\Request;
use Src\TransportePersonal\Ruta\Application\GetCollectionByClientUseCase;
use Src\TransportePersonal\Ruta\Infraestructure\Repositories\EloquentRutaRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentRutaRepository
     */
    private $repository;

    public function __construct( EloquentRutaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): array
    {
        $Id       = $request->id;

        $createRutaCase = new GetCollectionByClientUseCase( $this->repository );
        return $createRutaCase->__invoke(
            $Id,
        );
    }
}
