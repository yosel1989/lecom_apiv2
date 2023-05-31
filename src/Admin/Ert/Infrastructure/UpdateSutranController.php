<?php

namespace Src\Admin\Ert\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Ert\Application\UpdateSutranUseCase;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class UpdateSutranController
{

    /**
     * @var EloquentErtRepository
     */
    private $repository;


    public function __construct( EloquentErtRepository $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( Request $request ): void
    {

        $e_id = $request->id;
        $e_sutran = $request->input('sutran');

        $updateSutranUseCase = new UpdateSutranUseCase( $this->repository );
        $updateSutranUseCase->__invoke(
            $e_id,
            $e_sutran
        );

    }
}
