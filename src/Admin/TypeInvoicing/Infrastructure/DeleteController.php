<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypeInvoicing\Application\DeleteUseCase;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class DeleteController
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
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
