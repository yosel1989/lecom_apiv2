<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypeInvoicing\Application\TrashUseCase;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class TrashController
{
    private $repository;

    public function __construct(EloquentTypeInvoicingRepository $repository)
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
