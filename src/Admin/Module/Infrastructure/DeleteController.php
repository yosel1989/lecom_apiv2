<?php


namespace Src\Admin\Module\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Module\Application\DeleteUseCase;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class DeleteController
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
        $deleteModuleUseCase = new DeleteUseCase($this->repository);
        $deleteModuleUseCase->__invoke( $id );
    }
}
