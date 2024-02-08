<?php

namespace App\Http\Controllers\Api\V2\Export;

use App\Exports\Documentos\LiquidacionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Src\Utility\Utilidades;

class ExportController extends Controller
{
    private $excel;
    private \Src\V2\Liquidacion\Infrastructure\GetReporteByClienteController $controller;

    public function __construct(
        Excel $excel,
        \Src\V2\Liquidacion\Infrastructure\GetReporteByClienteController $controller)
    {
        $this->excel = $excel;
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {

        $request['idCliente'] = 'f5e6dc05-9e7d-404a-8e94-c6489fd2a6df';
        $request['fechaDesde'] = '2024-01-10';
        $request['fechaHasta'] = '2024-02-05';

        $liquidacion = $this->controller->__invoke($request);

        $utilidades = new Utilidades();



        return $this->excel->download(new LiquidacionExport($liquidacion, $utilidades), 'users.xlsx');

    }
}
