<?php

declare(strict_types=1);

namespace Src\V2\LiquidacionEstadoMotivo\Infrastructure\Repositories;

use App\Models\V2\LiquidacionEstadoMotivo as EloquentModelLiquidacion;
use Src\Core\Domain\ValueObjects\DateTimeFormat;
use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\V2\LiquidacionEstadoMotivo\Domain\Contracts\LiquidacionEstadoMotivoRepositoryContract;
use Src\V2\LiquidacionEstadoMotivo\Domain\LiquidacionEstadoMotivo;
use Src\V2\LiquidacionEstadoMotivo\Domain\LiquidacionEstadoMotivoList;

final class EloquentLiquidacionEstadoMotivoRepository implements LiquidacionEstadoMotivoRepositoryContract
{
    private EloquentModelLiquidacion $eloquent;

    public function __construct()
    {
        $this->eloquent = new EloquentModelLiquidacion;
    }

    public function create(
        Id $idCliente,
        Id $idLiquidacion,
        NumericInteger $idLiquidacionMotivo,
        Id $idUsuarioRegistro
    ): void{
        $this->eloquent->create([
            'id_cliente' => $idCliente->value(),
            'id_liquidacion' => $idLiquidacion->value(),
            'id_liquidacion_motivo' => $idLiquidacionMotivo->value(),
            'id_usu_registro' => $idUsuarioRegistro->value(),
        ]);
    }


    public function collectionByLiquidacion(Id $idLiquidacion): LiquidacionEstadoMotivoList
    {
        $collection = $this->eloquent
            ->where('id_liquidacion', $idLiquidacion->value())
            ->orderBy('f_registro','DESC')
            ->get();

        $output = new LiquidacionEstadoMotivoList();

        foreach ($collection as $model) {
            $OModel = new LiquidacionEstadoMotivo(
                new Id($model->id, false, 'El id no tiene el formato correcto'),
                new Id($model->id_cliente, false, 'El id del cliente no tiene el formato correcto'),
                new Id($model->id_liquidacion, false, 'El id de la liquidacion no tiene el formato correcto'),
                new NumericInteger($model->id_liquidacion_motivo),
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
