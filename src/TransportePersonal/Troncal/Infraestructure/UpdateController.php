<?php


namespace Src\TransportePersonal\Troncal\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\TransportePersonal\Troncal\Application\UpdateUseCase;
use Src\TransportePersonal\Troncal\Infraestructure\Repositories\EloquentTroncalRepository;

final class UpdateController
{

    /**
     * @var EloquentTroncalRepository
     */
    private $repository;

    public function __construct( EloquentTroncalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $name       = $request->input('nombre');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTroncalCase = new UpdateUseCase( $this->repository );
        $createTroncalCase->__invoke(
            $Id,
            $name,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
