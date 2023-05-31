<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\RestoreUserUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class RestoreUserController
{

    /**
     * @var EloquentUserRepository
     */
    private $repository;


    public function __construct( EloquentUserRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {

        $Cid = $request->id;

        $restoreUserUseCase = new RestoreUserUseCase( $this->repository );
        $restoreUserUseCase->__invoke(
            $Cid
        );

    }
}
