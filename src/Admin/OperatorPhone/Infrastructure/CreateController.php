<?php


namespace Src\Admin\OperatorPhone\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\OperatorPhone\Application\CreateUseCase;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class CreateController
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
    public function __invoke(Request $request): ?OperatorPhone
    {
        $id = Uuid::uuid4();
        $o_name = $request->input('name');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $o_name );
    }
}
