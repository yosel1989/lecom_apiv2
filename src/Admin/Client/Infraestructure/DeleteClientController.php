<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\DeleteClientUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class DeleteClientController
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

        $deleteClientUseCase = new DeleteClientUseCase( $this->repository );
        $deleteClientUseCase->__invoke(
            $Cid
        );

    }
}
