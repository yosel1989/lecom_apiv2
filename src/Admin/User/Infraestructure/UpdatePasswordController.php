<?php

namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\UpdatePasswordUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class UpdatePasswordController
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

        $Uid = $request->id;
        $Upassword = $request->input('password');

        $updatePasswordUseCase = new UpdatePasswordUseCase( $this->repository );
        $updatePasswordUseCase->__invoke(
            $Uid,
            $Upassword
        );

    }
}
