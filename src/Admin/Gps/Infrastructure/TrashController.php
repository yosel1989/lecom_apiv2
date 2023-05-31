<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\TrashUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
