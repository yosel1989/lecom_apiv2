<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\DeleteUseCase;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
