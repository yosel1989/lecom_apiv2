<?php

declare(strict_types=1);

namespace App\Exports\Documentos;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Src\V2\Liquidacion\Domain\Liquidacion;

class LiquidacionExport implements WithMultipleSheets
{
    use RegistersEventListeners;

    private Liquidacion $liquidacion;

    public function __construct($liquidacion)
    {
        $this->liquidacion = $liquidacion;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new LiquidacionTotalExport($this->liquidacion);

        foreach ( $this->liquidacion->getVehiculos()->all() as $item) {
            $sheets[] = new LiquidacionVehiculoFechaExport($item, $this->liquidacion);
        }

        return $sheets;
    }

}
