<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\TrashUseCase;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
