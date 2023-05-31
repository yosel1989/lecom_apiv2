<?php


namespace Src\Admin\Ert\Infrastructure;


use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Src\Admin\Ert\Application\CreateUseCase;
use Src\Admin\Ert\Domain\Ert;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class CreateController
{
    private $repository;

    public function __construct(EloquentErtRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?Ert
    {
        $id = Uuid::uuid4();
        $e_client = $request->input('client');
        $e_period = $request->input('period');
        $e_sutran = $request->input('sutran');
        $e_vehicle = $request->input('vehicle');
        $e_type = $request->input('type');
        $e_gps = $request->input('gps');
        $e_simcard = $request->input('simcard');
        $createUseCase = new CreateUseCase($this->repository);
        return $createUseCase->__invoke(
            $id,
            $e_period,
            $e_sutran,
            $e_client,
            $e_vehicle,
            $e_type,
            $e_gps,
            $e_simcard
        );
    }
}
