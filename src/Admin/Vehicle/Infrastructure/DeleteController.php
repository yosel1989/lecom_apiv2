<?php


namespace Src\Admin\Vehicle\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Vehicle\Application\DeleteUseCase;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
