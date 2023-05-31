<?php


namespace Src\Admin\SimCard\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\SimCard\Application\DeleteUseCase;
use Src\Admin\SimCard\Infrastructure\Repositories\EloquentSimCardRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
