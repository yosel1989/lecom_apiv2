<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\TrashUseCase;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
