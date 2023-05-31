<?php


namespace Src\Admin\OperatorPhone\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\OperatorPhone\Application\UpdateUseCase;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;
use Src\Admin\OperatorPhone\Infrastructure\Repositories\EloquentOperatorPhoneRepository;

final class UpdateController
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
        $id = $request->id;
        $b_name = $request->input('name');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $b_name );
    }
}
