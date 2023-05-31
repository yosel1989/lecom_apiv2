<?php


namespace Src\Admin\TypePay\Infrastructure;

use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\RestoreUseCase;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class RestoreController
{
    private $repository;

    public function __construct(EloquentTypePayRepository $repository)
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
