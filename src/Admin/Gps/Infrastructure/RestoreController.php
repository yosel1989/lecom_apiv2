<?php


namespace Src\Admin\Gps\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Gps\Application\RestoreUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentGpsRepository $repository)
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
