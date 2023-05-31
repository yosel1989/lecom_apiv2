<?php


namespace Src\Administracion\Personal\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\Personal\Application\CreateUseCase;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;

final class CreateController
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
        $id         = Uuid::uuid4();
        $name       = $request->input('nombres');
        $lastname       = $request->input('apellidos');
        $personalDocument       = $request->input('documentoIdentidad');
        $birthDay   = $request->input('fechaNacimiento');
        $idPersonalCategory   = $request->input('idCategoriaPersonal');
        $idClient   = $request->input('idCliente');
        $idStatus   = $request->input('idEstado');

        $createPersonalCase = new CreateUseCase( $this->repository );
        $createPersonalCase->__invoke(
            $id,
            $name,
            $lastname,
            $personalDocument,
            $birthDay,
            $idPersonalCategory,
            $idClient,
            $idStatus,
            $user->getId()
        );
    }
}
