<?php

declare(strict_types=1);

namespace Src\V2\OrigenBoleto\Infrastructure\Repositories;

use App\Models\V2\OrigenBoleto as EloquentModelOrigenBoleto;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\OrigenBoleto\Domain\Contracts\OrigenBoletoRepositoryContract;
use Src\V2\OrigenBoleto\Domain\OrigenBoletoShort;
use Src\V2\OrigenBoleto\Domain\OrigenBoletoShortList;

final class EloquentOrigenBoletoRepository implements OrigenBoletoRepositoryContract
{
    private EloquentModelOrigenBoleto $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelOrigenBoleto;
    }

    public function list(): OrigenBoletoShortList
    {
        $collection = new OrigenBoletoShortList();

        $models = $this->eloquent->select(
            'id',
            'nombre',
        )->get();

        foreach ( $models as $model ){

            $OModel = new OrigenBoletoShort(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1),
            );

            $collection->add($OModel);
        }

        return $collection;
    }



}
