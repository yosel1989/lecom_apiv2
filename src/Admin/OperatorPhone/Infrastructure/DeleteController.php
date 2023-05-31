<?php


namespace Src\Admin\OperatorPhone\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\OperatorPhone\Application\DeleteUseCase;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class DeleteController
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
    public function __invoke(Request $request): void
    {
        $id = $request->id;
        $deleteUseCase = new DeleteUseCase($this->repository);
        $deleteUseCase->__invoke( $id );
    }
}
