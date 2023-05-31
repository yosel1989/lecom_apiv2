<?php


namespace Src\Admin\Client\Infraestructure;


use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientUseCase;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;

final class GetClientController
{
    private $repository;

    public function __construct(EloquentClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): ?Client
    {
        $userId = $request->id;

        $getClientUseCase = new GetClientUseCase($this->repository);
        return $getClientUseCase->__invoke($userId);
    }
}
