<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\DeleteUserUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class DeleteUserController
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

        $deleteUserUseCase = new DeleteUserUseCase( $this->repository );
        $deleteUserUseCase->__invoke(
            $Cid
        );

    }
}
