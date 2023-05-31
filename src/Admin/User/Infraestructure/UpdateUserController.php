<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\UpdateUserUseCase;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class UpdateUserController
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

        $Uid = $request->id;
        $UfirstName = $request->input('firstname');
        $UlastName = $request->input('lastname');
        $Uemail = $request->input('email');
        $Uphone = $request->input('phone');
        $Ulevel = $request->input('level');
        $Uactived = $request->input('actived');
        $UidClient = $request->input('client');
        $UidRole = $request->input('role');

        $updateUserUseCase = new UpdateUserUseCase( $this->repository );
        return $updateUserUseCase->__invoke(
            $Uid,
            $UfirstName,
            $UlastName,
            $Uemail,
            $Uphone,
            $Uactived,
            $UidRole
        );

    }
}
