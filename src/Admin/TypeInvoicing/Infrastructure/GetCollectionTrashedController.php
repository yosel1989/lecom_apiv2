<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypeInvoicing\Application\GetCollectionTrashedUseCase;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class GetCollectionTrashedController
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
    public function __invoke(Request $request)
    {
        $getCollectionTrashedUseCase = new GetCollectionTrashedUseCase($this->repository);
        return $getCollectionTrashedUseCase->__invoke();
    }
}
