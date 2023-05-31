<?php


namespace Src\Admin\SimCard\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\RestoreUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentSimCardRepository $repository)
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
