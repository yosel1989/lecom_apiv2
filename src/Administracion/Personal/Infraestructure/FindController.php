<?php


namespace Src\Administracion\Personal\Infraestructure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\Administracion\Personal\Application\FindUseCase;
use Src\Administracion\Personal\Application\UpdateUseCase;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;

final class FindController
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

        $createPersonalCase = new FindUseCase( $this->repository );
        $createPersonalCase->__invoke(
            $Id,
        );
    }
}
