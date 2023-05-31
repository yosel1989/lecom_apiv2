<?php

namespace Src\Admin\User\Infraestructure;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\User\Application\CreateUserUseCase;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class CreateUserController
{

    /**
     * @var EloquentUserRepository
     */
    private $repository;

    public function __construct( EloquentUserRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): ?User
    {

        $Uid = Uuid::uuid4();
        $Uusername = $request->input('username');
        $Upassword = $request->input('password');
        $UfirstName = $request->input('firstname');
        $UlastName = $request->input('lastname');
        $Uemail = $request->input('email');
        $Uphone = $request->input('phone');
        $Ulevel = $request->input('level');
        $Uactived = $request->input('actived');
        $UidClient = $request->input('client');
        $UidRole = $request->input('role');

        $createUserCase = new CreateUserUseCase( $this->repository );
        return $createUserCase->__invoke(
            $Uid,
            $Uusername,
            $Upassword,
            $UfirstName,
            $UlastName,
            $Uemail,
            $Uphone,
            $Ulevel,
            $Uactived,
            $UidClient,
            $UidRole
        );

    }
}
