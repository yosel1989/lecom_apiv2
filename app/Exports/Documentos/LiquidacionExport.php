<?php

declare(strict_types=1);

namespace App\Exports\Documentos;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\AfterSheet;
use Src\Utility\Utilidades;
use Src\V2\Liquidacion\Domain\Liquidacion;

class LiquidacionExport implements WithMultipleSheets, WithEvents
{
    use RegistersEventListeners;

    private Liquidacion $liquidacion;
    private Utilidades $utilidades;

    public function __construct($liquidacion, $utilidades)
    {
        $this->liquidacion = $liquidacion;
        $this->utilidades = $utilidades;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new LiquidacionTotalExport($this->liquidacion, $this->utilidades);

        foreach ( $this->liquidacion->getVehiculos()->all() as $item) {
            $sheets[] = new LiquidacionVehiculoFechaExport($item, $this->liquidacion, $this->utilidades);
        }

        return $sheets;
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Arial', 'size' => 10],
        ];

        $strikethrough = [
            'font' => ['strikethrough' => true],
        ];

        // Get Worksheet
        $active_sheet = $event->sheet->getDelegate();

        // Apply Style Arrays
        $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);

    }

}
