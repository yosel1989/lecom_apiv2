<?php

declare(strict_types=1);

namespace Src\V2\EgresoEstadoMotivo\Infrastructure\Repositories;

use App\Models\V2\EgresoEstadoMotivo as EloquentModelEgreso;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\EgresoEstadoMotivo\Domain\Contracts\EgresoEstadoMotivoRepositoryContract;
use Src\V2\EgresoEstadoMotivo\Domain\EgresoEstadoMotivo;
use Src\V2\EgresoEstadoMotivo\Domain\EgresoEstadoMotivoList;

final class EloquentEgresoEstadoMotivoRepository implements EgresoEstadoMotivoRepositoryContract
{
    private EloquentModelEgreso $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelEgreso;
    }

    public function create(
        Id $idCliente,
        Id $idEgreso,
        NumericInteger $idEgresoMotivo,
        Id $idUsuarioRegistro
    ): void{
        $this->eloquent->create([
            'id_cliente' => $idCliente->value(),
            'id_egreso' => $idEgreso->value(),
            'id_egreso_motivo' => $idEgresoMotivo->value(),
            'id_usu_registro' => $idUsuarioRegistro->value(),
        ]);
    }


    public function collectionByEgreso(Id $idEgreso): EgresoEstadoMotivoList
    {
        $collection = $this->eloquent
            ->where('id_egreso', $idEgreso->value())
            ->orderBy('f_registro','DESC')
            ->get();

        $output = new EgresoEstadoMotivoList();

        foreach ($collection as $model) {
            $OModel = new EgresoEstadoMotivo(
                new Id($model->id, false, 'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_egreso, false, 'El id del egreso no tiene el formato correcto'),
                new NumericInteger($model->id_egreso_motivo),
                new Id($model->id_usu_registro, false, 'El id del usuario que registro no tiene el formato correcto'),
                new Id($model->id_usu_modifico, true, 'El id del ususario que modifico no tiene el formato correcto'),
                new DateTimeFormat($model->f_registro, false, 'La fecha de registro no tiene el formato correcto'),
                new DateTimeFormat($model->f_modifico, true, 'La fecha de modificación no tiene el formato correcto')
            );

            $output->add($OModel);
        }

        return $output;
    }

}
