<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\GetCollectionTrashedUseCase;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class GetCollectionTrashedController
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
    public function __invoke(Request $request)
    {
        $getCollectionTrashedUseCase = new GetCollectionTrashedUseCase($this->repository);
        return $getCollectionTrashedUseCase->__invoke();
    }
}
