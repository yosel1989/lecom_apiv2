<?php

declare(strict_types=1);

namespace Src\V2\TipoMoneda\Infrastructure\Repositories;

use App\Models\V2\TipoMoneda as EloquentModelTipoMoneda;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoMoneda\Domain\Contracts\TipoMonedaRepositoryContract;
use Src\V2\TipoMoneda\Domain\TipoMoneda;

final class EloquentTipoMonedaRepository implements TipoMonedaRepositoryContract
{
    private EloquentModelTipoMoneda $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelTipoMoneda = new EloquentModelTipoMoneda;
    }


    public function list(): array
    {
        $models = $this->eloquentModelTipoMoneda->all();

        $arr = array();

        foreach ( $models as $model ){

            $OModel = new TipoMoneda(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new Text($model->simbolo, false, -1, ''),
                new Text($model->valor, false, -1, '')
            );

            $arr[] = $OModel;
        }

        return $arr;
    }


}
