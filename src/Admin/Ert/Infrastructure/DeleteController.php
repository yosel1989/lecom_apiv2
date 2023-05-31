<?php


namespace Src\Admin\Ert\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Ert\Application\DeleteUseCase;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
