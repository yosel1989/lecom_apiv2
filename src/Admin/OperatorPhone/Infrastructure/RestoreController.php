<?php


namespace Src\Admin\OperatorPhone\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\OperatorPhone\Application\RestoreUseCase;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentOperatorPhoneRepository $repository)
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
        $restoreUseCase = new RestoreUseCase($this->repository);
        $restoreUseCase->__invoke( $id );
    }
}
