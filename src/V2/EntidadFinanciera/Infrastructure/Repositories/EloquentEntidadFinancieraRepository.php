<?php

declare(strict_types=1);

namespace Src\V2\EntidadFinanciera\Infrastructure\Repositories;

use App\Models\V2\EntidadFinanciera as EloquentModel;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\EntidadFinanciera\Domain\Contracts\EntidadFinancieraRepositoryContract;
use Src\V2\EntidadFinanciera\Domain\EntidadFinanciera;
use Src\V2\EntidadFinanciera\Domain\EntidadFinancieraList;

final class EloquentEntidadFinancieraRepository implements EntidadFinancieraRepositoryContract
{
    private EloquentModel $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModel;
    }



    public function list(): EntidadFinancieraList
    {
        $collection = $this->eloquent
            ->where('id_estado', 1)
            ->orderBy('nombre','ASC')
            ->get();

        $output = new EntidadFinancieraList();

        foreach ($collection as $model) {
            $OModel = new EntidadFinanciera(
                new NumericInteger($model->id),
                new Text($model->nombre, false, -1, '')
            );

            $output->add($OModel);
        }

        return $output;
    }

}
