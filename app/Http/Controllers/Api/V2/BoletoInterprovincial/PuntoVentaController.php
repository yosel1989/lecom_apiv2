<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PuntoVentaController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\PuntoVentaController $controller;


    public function __construct(\Src\V2\BoletoInterprovincial\Infrastructure\PuntoVentaController $controller)
    {
        $this->controller = $controller;
    }

    public function __invoke(Request $request)
    {
        try {

            //return response()->json(BoletoInterprovincial::all());


            $boleto = $this->controller->__invoke($request);

            // generando el qr
            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(100)->errorCorrection('M')->generate($boleto->generateQr()));

            // Creando pdf boleto
            $formatter = new NumeroALetras();
            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boleto', 'formatter', 'qrcode'))
                ->setPaper(array( 0 , 0 , 226.77 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
            $page_count = $pdf->getCanvas()->get_page_number();

//            dd($pdf->getCanvas( ));
            unset( $pdf );
            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boleto', 'formatter', 'qrcode'))
                ->setPaper(array( 0 , 0 , 226.77 * $page_count + 320 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output(['Attachment' => 0])),
                'trace' => null,
//                'dd' => $pdf->getCanvas( ),
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'd' => $page_count,
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'status' => $e->getCode()
            ]);

        }
    }
}
