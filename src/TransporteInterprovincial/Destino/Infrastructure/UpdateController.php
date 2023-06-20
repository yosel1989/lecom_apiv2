<?php


namespace Src\TransporteInterprovincial\Destino\Infrastructure;


use Illuminate\Http\Request;
use Src\TransporteInterprovincial\Destino\Application\UpdateUseCase;
use Src\TransporteInterprovincial\Destino\Domain\Destino;
use Src\TransporteInterprovincial\Destino\Infrastructure\Repositories\EloquentDestinoRepository;

final class UpdateController
{
    private $repository;

    public function __construct(EloquentDestinoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request): ?Destino
    {
        $id = $request->id;
        $v_plate = $request->input('plate');
        $v_unit = $request->input('unit');
        $v_category = $request->input('category');
        $v_brand = $request->input('brand');
        $v_model = $request->input('model');
        $v_class = $request->input('class');
        $updateUseCase = new UpdateUseCase($this->repository);
        return $updateUseCase->__invoke(
            $id,
            $v_plate,
            $v_unit,
            $v_category,
            $v_brand,
            $v_model,
            $v_class,
            null
        );
    }
}
