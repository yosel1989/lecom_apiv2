<?php

declare(strict_types=1);

namespace Src\V2\TipoSerie\Infrastructure\Repositories;

use App\Models\V2\TipoSerie as EloquentModelTipoSerie;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoSerie\Domain\Contracts\TipoSerieRepositoryContract;
use Src\V2\TipoSerie\Domain\TipoSerie;

final class EloquentTipoSerieRepository implements TipoSerieRepositoryContract
{
    private EloquentModelTipoSerie $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelTipoSerie = new EloquentModelTipoSerie;
    }

    public function list(): array
    {
        $models = $this->eloquentModelTipoSerie->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoSerie(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, '')
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }

}
