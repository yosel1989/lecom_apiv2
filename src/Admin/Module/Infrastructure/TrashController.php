<?php


namespace Src\Admin\Module\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Module\Application\TrashUseCase;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class TrashController
{
    private $repository;

    public function __construct(EloquentModuleRepository $repository)
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
