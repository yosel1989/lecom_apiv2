<?php


namespace Src\Admin\Gps\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\Gps\Application\CreateUseCase;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\Gps\Infrastructure\Repositories\EloquentGpsRepository;

final class CreateController
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
        $id = Uuid::uuid4();
        $g_imei = $request->input('imei');
        $g_model = $request->input('model');
        $g_client = $request->input('client');
        $g_type = $request->input('type');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke( $id, $g_imei, $g_model, $g_type, $g_client );
    }
}
