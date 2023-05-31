<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Gps\Application\UpdateUseCase;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class UpdateController
{
    private $repository;

    public function __construct(EloquentGpsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?Gps
    {
        $id = $request->id;
        $g_imei = $request->input('imei');
        $g_model = $request->input('model');
        $g_type = $request->input('type');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke( $id, $g_imei, $g_model, $g_type );
    }
}
