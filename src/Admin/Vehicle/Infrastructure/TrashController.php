<?php


namespace Src\Admin\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Vehicle\Application\TrashUseCase;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class TrashController
{
    private $repository;

    public function __construct(EloquentVehicleRepository $repository)
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
