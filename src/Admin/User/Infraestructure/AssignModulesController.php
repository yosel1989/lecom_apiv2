<?php

namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\AssignModulesUseCase;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class AssignModulesController
{

    /**
     * @var EloquentUserRepository
     */
    private $repository;


    public function __construct( EloquentUserRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): User
    {

        $Uid = $request->id;
        $modules = $request->input('modules');

        $assignModulesUseCase = new AssignModulesUseCase( $this->repository );
        return $assignModulesUseCase->__invoke(
            $Uid,
            $modules
        );

    }
}
