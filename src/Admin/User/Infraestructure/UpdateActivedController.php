<?php

namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\UpdateActivedUseCase;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class UpdateActivedController
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
        $Uactived = $request->input('actived');

        $updateActivedUseCase = new UpdateActivedUseCase( $this->repository );
        $updateActivedUseCase->__invoke(
            $Uid,
            $Uactived
        );

    }
}
