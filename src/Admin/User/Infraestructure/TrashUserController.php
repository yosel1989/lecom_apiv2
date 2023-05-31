<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\TrashUserUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class TrashUserController
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

        $trashUserUseCase = new TrashUserUseCase( $this->repository );
        $trashUserUseCase->__invoke(
            $Cid
        );

    }
}
