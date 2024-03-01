<?php


namespace App\Http\Controllers\Api\V2\Ingreso;


use App\Http\Controllers\Controller;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{


    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $pdf = PDF::loadView('comprobantes.comprobante-ingresos');
        return $pdf->download();
    }
}
