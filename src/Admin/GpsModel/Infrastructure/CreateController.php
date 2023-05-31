<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\GpsModel\Application\CreateUseCase;
use Src\Admin\GpsModel\Domain\GpsModel;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentGpsModelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?GpsModel
    {
        $id = Uuid::uuid4();
        $g_name = $request->input('name');
        $g_input = $request->input('input');
        $g_output = $request->input('output');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $g_name, $g_input, $g_output );
    }
}
