<?php

declare(strict_types=1);

namespace App\Exports\Documentos;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Src\Utility\Utilidades;
use Src\V2\Liquidacion\Domain\Liquidacion;

class LiquidacionTotalExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    use RegistersEventListeners;

    private Liquidacion $liquidacion;
    private Utilidades $utilidades;

    public function __construct($liquidacion, $utilidades)
    {
        $this->liquidacion = $liquidacion;
        $this->utilidades = $utilidades;
    }


    public function title(): string
    {
        return 'Total';
    }

    public function view(): View
    {
        return view('documentos.liquidacion', [
            'liquidacion' => $this->liquidacion,
            'utilidades' => $this->utilidades,
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Arial', 'size' => 10],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#000000'],
                ],
            ],
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
