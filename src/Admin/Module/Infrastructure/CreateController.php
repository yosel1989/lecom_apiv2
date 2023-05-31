<?php


namespace Src\Admin\Module\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\Module\Application\CreateUseCase;
use Src\Admin\Module\Domain\Module;
use Src\Admin\Module\Infrastructure\Repositories\EloquentModuleRepository;

final class CreateController
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
        $id = Uuid::uuid4();
        $m_name = $request->input('name');
        $m_shortname = $request->input('shortname');
        $createModuleUseCase = new CreateUseCase($this->repository);
        return $createModuleUseCase->__invoke( $id, $m_name, $m_shortname );
    }
}
