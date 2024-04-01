<?php

declare(strict_types=1);

namespace Src\V2\Genero\Infrastructure\Repositories;

use App\Models\V2\Genero as EloquentModelGenero;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\Genero\Domain\Contracts\GeneroRepositoryContract;
use Src\V2\Genero\Domain\Genero;

final class EloquentGeneroRepository implements GeneroRepositoryContract
{
    private EloquentModelGenero $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelGenero = new EloquentModelGenero;
    }


    public function list(): array
    {
        $models = $this->eloquentModelGenero->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new Genero(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->id_estado),
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


}
