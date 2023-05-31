<?php


namespace Src\Admin\GpsModel\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\GpsModel\Application\UpdateUseCase;
use Src\Admin\GpsModel\Domain\GpsModel;
use Src\Admin\GpsModel\Infrastructure\Repositories\EloquentGpsModelRepository;

final class UpdateController
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
        $id = $request->id;
        $g_name = $request->input('name');
        $g_input = $request->input('input');
        $g_output = $request->input('output');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $g_name, $g_input, $g_output );
    }
}
