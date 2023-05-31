<?php

namespace Src\Admin\Module\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\Module\Application\GetCollectionUseCase;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class GetCollectionController
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
    public function __invoke(Request $request)
    {
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
