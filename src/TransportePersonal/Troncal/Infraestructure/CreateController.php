<?php


namespace Src\TransportePersonal\Troncal\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\TransportePersonal\Troncal\Application\CreateUseCase;
use Src\TransportePersonal\Troncal\Infraestructure\Repositories\EloquentTroncalRepository;

final class CreateController
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
        $Id         = Uuid::uuid4();
        $name       = $request->input('nombre');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createTroncalCase = new CreateUseCase( $this->repository );
        $createTroncalCase->__invoke(
            $Id,
            $name,
            $idStatus,
            $user->getId(),
            $idClient
        );
    }
}
