<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\DeleteUseCase;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
