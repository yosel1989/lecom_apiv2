<?php


namespace Src\Administracion\PersonalCategoria\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Src\Administracion\PersonalCategoria\Application\CreateUseCase;
use Src\Administracion\PersonalCategoria\Infraestructure\Repositories\EloquentPersonalCategoriaRepository;

final class CreateController
{

    /**
     * @var EloquentPersonalCategoriaRepository
     */
    private $repository;

    public function __construct( EloquentPersonalCategoriaRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {
        $user = Auth::user();
        $Id         = Uuid::uuid4();
        $name       = $request->input('nombre');
        $code   = $request->input('codigo');
        $idStatus   = $request->input('idEstado');

        $createPersonalCategoriaCase = new CreateUseCase( $this->repository );
        $createPersonalCategoriaCase->__invoke(
            $Id,
            $name,
            $code,
            $idStatus,
            $user->getId(),
        );
    }
}
