<?php

declare(strict_types=1);

namespace Src\V2\TipoDocumento\Infrastructure\Repositories;

use App\Models\V2\TipoDocumento as EloquentModelTipoDocumento;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\TipoDocumento\Domain\Contracts\TipoDocumentoRepositoryContract;
use Src\V2\TipoDocumento\Domain\TipoDocumento;

final class EloquentTipoDocumentoRepository implements TipoDocumentoRepositoryContract
{
    private EloquentModelTipoDocumento $eloquentVehicleModel;

    public function __construct()
    {
        $this->eloquentModelTipoDocumento = new EloquentModelTipoDocumento;
    }


    public function list(): array
    {
        $models = $this->eloquentModelTipoDocumento->get();

        $arrVehicles = array();

        foreach ( $models as $model ){

            $OModel = new TipoDocumento(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->numeroDigitos)
            );

            $arrVehicles[] = $OModel;
        }

        return $arrVehicles;
    }


}
