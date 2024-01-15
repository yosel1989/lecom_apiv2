<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PuntoVentaController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\PuntoVentaController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;
    private \Src\V2\ComprobanteElectronico\Infrastructure\CreateToBoletoController $controllerComprobante;


    public function __construct(
        \Src\V2\BoletoInterprovincial\Infrastructure\PuntoVentaController $controller,
        \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion,
        \Src\V2\ComprobanteElectronico\Infrastructure\CreateToBoletoController $controllerComprobante
    )
    {
        $this->controller = $controller;
        $this->controllerConfiguracion = $controllerConfiguracion;
        $this->controllerComprobante = $controllerComprobante;
    }

    public function __invoke(Request $request)
    {
        try {

            $usuario = Auth::user();

            //return response()->json(BoletoInterprovincial::all());

            $boleto = $this->controller->__invoke($request);
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            $comprobante = $this->controllerComprobante->__invoke($request, $boleto);

            // generando el qr
//            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(100)->errorCorrection('M')->generate(
//                $comprobante->getSerie()->value() . ' | ' .
//                $comprobante->getNumero()->value() . ' | ' .
//                $comprobante->getIdProducto()->value() . ' | ' .
//                $comprobante->getFechaRegistro()->value() . ' | ' .
//                $boleto->getNumeroDocumento()->value()
//            ));
//            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(100)->errorCorrection('M')->generate('ddddddd'));

            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(80)->errorCorrection('L')->generate(
                $boleto->getId()->value()
            ));

            // Creando pdf boleto
            $formatter = new NumeroALetras();
            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boleto', 'configuracion', 'comprobante', 'usuario', 'formatter', 'qrcode'))
                ->setPaper(array( 0 , 0 , 226.77 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
            $page_count = $pdf->getCanvas()->get_page_number();

//            dd($pdf->getCanvas( ));
            unset( $pdf );
            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boleto', 'configuracion', 'comprobante', 'usuario', 'formatter', 'qrcode'))
                ->setPaper(array( 0 , 0 , 226.77 * $page_count + 400 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
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
//                'd' => $page_count,
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
