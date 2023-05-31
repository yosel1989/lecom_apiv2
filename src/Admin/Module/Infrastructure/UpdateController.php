<?php


namespace Src\Admin\Module\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Module\Application\UpdateUseCase;
use Src\Admin\Module\Domain\Module;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class UpdateController
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
    public function __invoke(Request $request): ?Module
    {
        $id = $request->id;
        $m_name = $request->input('name');
        $m_shortname = $request->input('shortname');
        $updateModuleUseCase = new UpdateUseCase($this->repository);
        return $updateModuleUseCase->__invoke( $id, $m_name, $m_shortname );
    }
}
