<?php

namespace App\Exports\Ticket;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TicketExport implements FromView, ShouldAutoSize, WithStyles, WithPreCalculateFormulas,WithColumnFormatting, WithEvents
{
    use Exportable;

    private $tickets;
    private $listDates;
    private $fini;
    private $ffin;
    private $resumenTurn;

    public function __construct(array $tickets,$fini,$ffin)
    {
        $this->tickets = $tickets;
        $this->fini = $fini;
        $this->ffin = $ffin;
        $this->listDates = $this->setListDates($tickets);
        $this->resumenTurn = $this->setResumenTurn($tickets);
    }

    public function columnFormats(): array
    {
        return [
            'E' => '"S/ "#,##0.00_-',
            'P' => '"S/ "#,##0.00_-',
            'X' => '"S/ "#,##0.00_-',
            'G' => '@',
            'L' => '@',
            'M' => '@',
            'T' => '@',
            'U' => '@',
        ];
    }


    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'L1'    => ['font' => ['bold' => true, 'size' => 15], 'alignment' => ['horizontal' => 'center']],
            'T1'    => [
                'font' => ['bold' => true, 'size' => 15], 'alignment' => ['horizontal' => 'center'],
            ],
            'A2:H2'    => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFF'],],
                'fill' => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '3276b1',
                    ]
                ]
            ],
            'T2:X2'    => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFF'],],
                'fill' => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '3276b1',
                    ]
                ]
            ],
            'L2:P2'    => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['argb' => 'FFFFFF'],],
                'fill' => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '3276b1',
                    ]
                ]
            ],
            'O'. (count($this->listDates) + 4) => [
                'font' => ['bold' => true, 'size' => 12],
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();
                $firstHeaders = 'A2:H2'; // All headers

                $sheet->setAutoFilter( 'A2:H2');

                $sheet->getStyle('J')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3276b1');
                $event->sheet->getColumnDimension('J')->setAutoSize(false);
                $sheet->getColumnDimension('J')->setWidth(.5);


                /** RESUMEN **/
                $sheet->setMergeCells(['L1:P1','A1:H1','T1:X1']);

                $sheet->setCellValue('L1', 'RESUMEN DE REPORTE');
                $sheet->setCellValue('L2', 'MES');
                $sheet->setCellValue('M2', 'DÍA');
                $sheet->setCellValue('N2', 'N° BOLETOS');
                $sheet->setCellValue('O2', 'N° VUELTAS');
                $sheet->setCellValue('P2', 'TOTAL');
                foreach ( $this->listDates as $index => $resumen ){
                    $date = new \DateTime($resumen->date);
                    $sheet->setCellValue('L'. ( $index + 3 ), $date->format('m'));
                    $sheet->setCellValue('M'. ( $index + 3 ), $date->format('d'));
                    $sheet->setCellValue('N'. ( $index + 3 ), $resumen->count);
                    $sheet->setCellValue('O'. ( $index + 3 ), $resumen->turn);
                    $sheet->setCellValue('P'. ( $index + 3 ), $resumen->total);
                }
                $sheet->setCellValue('O'. (count($this->listDates) + 4), 'TOTAL');
                $sheet->setCellValue('P'. (count($this->listDates) + 4), '=SUM(P3:P'. (count($this->listDates) + 3) . ')');


                $sheet->getStyle('R')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('3276b1');
                $event->sheet->getColumnDimension('R')->setAutoSize(false);
                $sheet->getColumnDimension('R')->setWidth(.5);


                $sheet->setCellValue('T1', 'RESUMEN POR VUELTA');
                $sheet->setCellValue('T2', 'MES');
                $sheet->setCellValue('U2', 'DÍA');
                $sheet->setCellValue('V2', 'VUELTA');
                $sheet->setCellValue('W2', 'N° BOLETOS');
                $sheet->setCellValue('X2', 'TOTAL');
                foreach ( $this->resumenTurn as $index => $resumen ){
                    $date = new \DateTime($resumen->date);
                    $sheet->setCellValue('T'. ( $index + 3 ), $date->format('m'));
                    $sheet->setCellValue('U'. ( $index + 3 ), $date->format('d'));
                    $sheet->setCellValue('V'. ( $index + 3 ), $resumen->turn);
                    $sheet->setCellValue('W'. ( $index + 3 ), $resumen->count);
                    $sheet->setCellValue('X'. ( $index + 3 ), $resumen->total);
                }


            },
        ];
    }

    public function view(): View
    {
        return view('Excel.Ticket.reportVehicle',[
            'tickets' => $this->tickets,
            'fini' => $this->fini,
            'ffin' => $this->ffin
        ]);
    }

    public function setListDates( array $tickets ): array
    {
        $dates = [];
        $resumen = [];
        $i = 0;
        if(count($tickets)){

            foreach ( $tickets as $index => $ticket ){

                if($index){
                    $date = new \DateTime($ticket->getDate()->value());
                    if( !in_array($date->format('Y-m-d'), $dates, TRUE) ){
                        $dates[] = $date->format('Y-m-d');
                    }

                    if($resumen[$i]->date === $date->format('Y-m-d')){
                        $resumen[$i]->total += $ticket->getPrice()->getPrice()->value();
                        $resumen[$i]->count += 1;
                        if( $ticket->getTurn()->value() > $resumen[$i]->turn ){
                            $resumen[$i]->turn = $ticket->getTurn()->value();
                        }

                    }else{
                        $i++;
                        $resumen[] = (object)[
                            'date' => $date->format('Y-m-d'),
                            'turn' => $ticket->getTurn()->value(),
                            'count' => 1,
                            'total' => $ticket->getPrice()->getPrice()->value()
                        ];
                    }

                }else{
                    $date = new \DateTime($ticket->getDate()->value());
                    $dates[] = $date->format('Y-m-d');

                    $resumen[] = (object)[
                        'date' => $date->format('Y-m-d'),
                        'turn' => $ticket->getTurn()->value(),
                        'count' => 1,
                        'total' => $ticket->getPrice()->getPrice()->value()
                    ];
                }

            }

        }

        return $resumen;
    }

    public function setResumenTurn( array $tickets ): array
    {
        $resumen = [];
        $i = 0;
        if(count($tickets)){

            foreach ( $tickets as $index => $ticket ){

                if($index){
                    $date = new \DateTime($ticket->getDate()->value());

                    if($resumen[$i]->date === $date->format('Y-m-d') && $resumen[$i]->turn === $ticket->getTurn()->value()){
                        $resumen[$i]->total += $ticket->getPrice()->getPrice()->value();
                        $resumen[$i]->count += 1;
                    }else{
                        $i++;
                        $resumen[] = (object)[
                            'date' => $date->format('Y-m-d'),
                            'turn' => $ticket->getTurn()->value(),
                            'count' => 1,
                            'total' => $ticket->getPrice()->getPrice()->value()
                        ];
                    }

                }else{
                    $date = new \DateTime($ticket->getDate()->value());
                    $dates[] = $date->format('Y-m-d');

                    $resumen[] = (object)[
                        'date' => $date->format('Y-m-d'),
                        'turn' => $ticket->getTurn()->value(),
                        'count' => 1,
                        'total' => $ticket->getPrice()->getPrice()->value()
                    ];
                }

            }

        }

        return $resumen;
    }
}
