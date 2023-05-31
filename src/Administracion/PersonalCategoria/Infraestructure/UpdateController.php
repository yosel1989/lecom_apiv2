<?php


namespace Src\Administracion\PersonalCategoria\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\PersonalCategoria\Application\UpdateUseCase;
use Src\Administracion\PersonalCategoria\Infraestructure\Repositories\EloquentPersonalCategoriaRepository;

final class UpdateController
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
        $Id       = $request->id;
        $name       = $request->input('nombre');
        $code   = $request->input('codigo');
        $idStatus   = $request->input('idEstado');

        $createPersonalCategoriaCase = new UpdateUseCase( $this->repository );
        $createPersonalCategoriaCase->__invoke(
            $Id,
            $name,
            $code,
            $idStatus,
            $user->getId()
        );
    }
}
