<?php

declare(strict_types=1);

namespace Src\V2\TipoRuta\Infrastructure\Repositories;

use App\Models\V2\TipoRuta as EloquentModelTipoRuta;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoRuta\Domain\Contracts\TipoRutaRepositoryContract;
use Src\V2\TipoRuta\Domain\TipoRuta;

final class EloquentTipoRutaRepository implements TipoRutaRepositoryContract
{
    /**
     * @var EloquentModelTipoRuta
     */
    private EloquentModelTipoRuta $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelTipoRuta = new EloquentModelTipoRuta;
    }


    public function list(): array
    {
        $models = $this->eloquentModelTipoRuta->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoRuta(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, '')
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


}
