<?php


namespace Src\Administracion\HojaRuta\Infraestructure;


use Illuminate\Http\Request;
use Src\Administracion\HojaRuta\Application\GetCollectionByClientByDateUseCase;
use Src\Administracion\HojaRuta\Infraestructure\Repositories\EloquentHojaRutaRepository;

final class GetCollectionByClientByDateController
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
        $Fecha       = $request->fecha;

        $createParaderoCase = new GetCollectionByClientByDateUseCase( $this->repository );
        return $createParaderoCase->__invoke(
            $Id,
            $Fecha
        );
    }
}
