<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\DeleteUseCase;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
