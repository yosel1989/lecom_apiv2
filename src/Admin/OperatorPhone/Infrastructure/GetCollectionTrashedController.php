<?php


namespace Src\Admin\OperatorPhone\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\OperatorPhone\Application\GetCollectionTrashedUseCase;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class GetCollectionTrashedController
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
        $getCollectionTrashedUseCase = new GetCollectionTrashedUseCase($this->repository);
        return $getCollectionTrashedUseCase->__invoke();
    }
}
