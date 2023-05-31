<?php


namespace Src\Admin\Ert\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Ert\Application\TrashUseCase;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
