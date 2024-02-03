<?php

declare(strict_types=1);

namespace App\Exports\Documentos;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Src\Utility\Utilidades;
use Src\V2\Liquidacion\Domain\Liquidacion;
use Src\V2\Vehiculo\Domain\VehiculoShort;

class LiquidacionVehiculoFechaExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    use RegistersEventListeners;

    private VehiculoShort $vehiculo;
    private Liquidacion $liquidacion;
    private Utilidades $utilidades;

    public function __construct($vehiculo, $liquidacion, $utilidades)
    {
        $this->vehiculo = $vehiculo;
        $this->liquidacion = $liquidacion;
        $this->utilidades = $utilidades;
    }

    public function title(): string
    {
        return $this->vehiculo->getPlaca()->value();
    }

    public function view(): View
    {
        return view('documentos.liquidacion-vehiculo-fecha', [
            'vehiculo' => $this->vehiculo,
            'liquidacion' => $this->liquidacion,
            'utilidades' => $this->utilidades,
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Calibri']
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
