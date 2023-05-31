<?php


namespace Src\Admin\User\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\User\Application\GetUserUseCase;
use Src\Admin\User\Domain\User;
use Src\Admin\User\Infraestructure\Repositories\EloquentUserRepository;

final class GetUserController
{
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): ?User
    {
        $userId = $request->id;

        $getUserUseCase = new GetUserUseCase($this->repository);
        return $getUserUseCase->__invoke($userId);
    }
}
