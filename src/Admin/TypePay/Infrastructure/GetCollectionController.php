<?php


namespace Src\Admin\TypePay\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\TypePay\Application\GetCollectionUseCase;
use Src\Admin\TypePay\Infrastructure\Repositories\EloquentTypePayRepository;

final class GetCollectionController
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
    public function __invoke(Request $request): array
    {
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
