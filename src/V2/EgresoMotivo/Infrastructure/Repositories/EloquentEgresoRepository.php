<?php

declare(strict_types=1);

namespace Src\V2\EgresoMotivo\Infrastructure\Repositories;

use App\Models\V2\EgresoMotivo as EloquentModelEgreso;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EgresoMotivo\Domain\Contracts\EgresoRepositoryContract;
use Src\V2\EgresoMotivo\Domain\EgresoMotivo;
use Src\V2\EgresoMotivo\Domain\EgresoMotivoList;

final class EloquentEgresoRepository implements EgresoRepositoryContract
{
    private EloquentModelEgreso $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgreso;
    }



    public function collectionByEstado(NumericInteger $idEstado): EgresoMotivoList
    {
        $collection = $this->eloquent
            ->where('id_estado', $idEstado->value())
            ->orderBy('nombre','ASC')
            ->get();

        $output = new EgresoMotivoList();

        foreach ($collection as $model) {
            $OModel = new EgresoMotivo(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->id_estado),
            );

            $output->add($OModel);
        }

        return $output;
    }

}
