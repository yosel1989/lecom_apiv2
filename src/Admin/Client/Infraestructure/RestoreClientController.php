<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\RestoreClientUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class RestoreClientController
{

    /**
     * @var EloquentClientRepository
     */
    private $repository;


    public function __construct( EloquentClientRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {

        $Cid = $request->id;

        $restoreClientUseCase = new RestoreClientUseCase( $this->repository );
        $restoreClientUseCase->__invoke(
            $Cid
        );

    }
}
