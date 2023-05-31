<?php


namespace Src\Admin\Module\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Module\Application\RestoreUseCase;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class RestoreController
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
        $restoreModuleUseCase = new RestoreUseCase($this->repository);
        $restoreModuleUseCase->__invoke( $id );
    }
}
