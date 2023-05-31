<?php


namespace Src\Admin\TypeInvoicing\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypeInvoicing\Application\GetCollectionUseCase;
use Src\Admin\TypeInvoicing\Infrastructure\Repositories\EloquentTypeInvoicingRepository;

final class GetCollectionController
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
    public function __invoke(Request $request): array
    {
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
