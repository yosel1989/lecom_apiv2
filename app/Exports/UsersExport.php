<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Src\V2\Liquidacion\Domain\Liquidacion;

class UsersExport implements FromView, ShouldAutoSize, WithEvents, WithTitle
{
    use RegistersEventListeners;

    private Liquidacion $liquidacion;

    public function __construct($liquidacion)
    {
        $this->liquidacion = $liquidacion;
    }

    public function title(): string
    {
        return 'Total';
    }

    public function view(): View
    {
        return view('documentos.liquidacion', [
            'liquidacion' => $this->liquidacion,
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Calibri', 'size' => 9]
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
