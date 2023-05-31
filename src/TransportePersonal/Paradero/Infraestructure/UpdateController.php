<?php


namespace Src\TransportePersonal\Paradero\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransportePersonal\Paradero\Application\UpdateUseCase;
use Src\TransportePersonal\Paradero\Infraestructure\Repositories\EloquentParaderoRepository;

final class UpdateController
{

    /**
     * @var EloquentParaderoRepository
     */
    private $repository;

    public function __construct( EloquentParaderoRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $name       = $request->input('nombre');
        $shortName  = $request->input('nombreCorto');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createParaderoCase = new UpdateUseCase( $this->repository );
        $createParaderoCase->__invoke(
            $Id,
            $name,
            $shortName,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
