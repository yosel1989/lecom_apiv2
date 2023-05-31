<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\TrashClientUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class TrashClientController
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

        $trashClientUseCase = new TrashClientUseCase( $this->repository );
        $trashClientUseCase->__invoke(
            $Cid
        );

    }
}
