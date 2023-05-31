<?php

namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\AssignVehiclesUseCase;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class AssignVehiclesController
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
        $vehicles = $request->input('idVehiculos');
        $uuids = [];
        for( $i = 0 ; $i < count(explode(",", $vehicles)) ; $i++  ){
            $uuids[] = \Ramsey\Uuid\Uuid::uuid4()->toString();
        }

        $assignModulesUseCase = new AssignVehiclesUseCase( $this->repository );
        $assignModulesUseCase->__invoke(
            $Uid,
            explode(",", $vehicles),
            $uuids
        );

    }
}
