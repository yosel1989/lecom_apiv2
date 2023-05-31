<?php


namespace Src\Admin\GpsModel\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\RestoreUseCase;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentGpsModelRepository $repository)
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
