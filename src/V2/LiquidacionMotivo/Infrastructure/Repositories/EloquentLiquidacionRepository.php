<?php

declare(strict_types=1);

namespace Src\V2\LiquidacionMotivo\Infrastructure\Repositories;

use App\Models\V2\LiquidacionMotivo as EloquentModelLiquidacion;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\LiquidacionMotivo\Domain\Contracts\LiquidacionRepositoryContract;
use Src\V2\LiquidacionMotivo\Domain\LiquidacionMotivo;
use Src\V2\LiquidacionMotivo\Domain\LiquidacionMotivoList;

final class EloquentLiquidacionRepository implements LiquidacionRepositoryContract
{
    private EloquentModelLiquidacion $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelLiquidacion;
    }



    public function collectionByEstado(NumericInteger $idEstado): LiquidacionMotivoList
    {
        $collection = $this->eloquent
            ->where('id_estado', $idEstado->value())
            ->orderBy('nombre','ASC')
            ->get();

        $output = new LiquidacionMotivoList();

        foreach ($collection as $model) {
            $OModel = new LiquidacionMotivo(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, ''),
                new NumericInteger($model->id_estado),
            );

            $output->add($OModel);
        }

        return $output;
    }

}
