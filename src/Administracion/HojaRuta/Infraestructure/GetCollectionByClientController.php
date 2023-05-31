<?php


namespace Src\Administracion\HojaRuta\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\HojaRuta\Application\GetCollectionByClientUseCase;
use Src\Administracion\HojaRuta\Infraestructure\Repositories\EloquentHojaRutaRepository;

final class GetCollectionByClientController
{

    /**
     * @var EloquentHojaRutaRepository
     */
    private $repository;

    public function __construct( EloquentHojaRutaRepository $repository )
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
