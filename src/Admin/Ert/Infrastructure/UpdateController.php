<?php


namespace Src\Admin\Ert\Infrastructure;


use Illuminate\Http\Request;
use Src\Admin\Ert\Application\UpdateUseCase;
use Src\Admin\Ert\Domain\Ert;
use Src\Admin\Ert\Infrastructure\Repositories\EloquentErtRepository;

final class UpdateController
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
        $id = $request->id;
        $e_period = $request->input('period');
        $e_sutran = $request->input('sutran');
        $e_vehicle = $request->input('vehicle');
        $e_type = $request->input('type');
        $e_gps = $request->input('gps');
        $e_simcard = $request->input('simcard');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke(
            $id,
            $e_period,
            $e_sutran,
            $e_vehicle,
            $e_type,
            $e_gps,
            $e_simcard
        );
    }
}
