<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\TrashUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class TrashController
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
        $trashUseCase = new TrashUseCase($this->repository);
        $trashUseCase->__invoke( $id );
    }
}
