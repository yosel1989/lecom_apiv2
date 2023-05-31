<?php


namespace Src\Admin\Ert\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Ert\Application\RestoreUseCase;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentErtRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $restoreUseCase = new RestoreUseCase($this->repository);
        $restoreUseCase->__invoke( $id );
    }
}
