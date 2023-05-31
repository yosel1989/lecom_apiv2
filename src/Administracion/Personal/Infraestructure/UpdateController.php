<?php


namespace Src\Administracion\Personal\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Personal\Application\UpdateUseCase;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;

final class UpdateController
{

    /**
     * @var EloquentPersonalRepository
     */
    private $repository;

    public function __construct( EloquentPersonalRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id       = $request->id;
        $name       = $request->input('nombres');
        $lastname       = $request->input('apellidos');
        $personalDocument       = $request->input('documentoIdentidad');
        $birthDay   = $request->input('fechaNacimiento');
        $idPersonalCategory   = $request->input('idCategoriaPersonal');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createPersonalCase = new UpdateUseCase( $this->repository );
        $createPersonalCase->__invoke(
            $Id,
            $name,
            $lastname,
            $personalDocument,
            $birthDay,
            $idPersonalCategory,
            $idClient,
            $idStatus,
            $user->getId(),
        );
    }
}
