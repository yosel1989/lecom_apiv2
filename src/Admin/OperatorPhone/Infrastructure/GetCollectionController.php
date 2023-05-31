<?php


namespace Src\Admin\OperatorPhone\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\OperatorPhone\Application\GetCollectionUseCase;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class GetCollectionController
{
    private $repository;

    public function __construct(EloquentOperatorPhoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $getCollectionUseCase = new GetCollectionUseCase($this->repository);
        return $getCollectionUseCase->__invoke();
    }
}
