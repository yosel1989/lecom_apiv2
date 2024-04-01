<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            DB::beginTransaction();

            $usuario = Auth::user();

            $numBoletos = (int)$request->input('numBoletos');

            // Obtener datos de la empresa
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            // Utilidad para transformar número a letras
            $formatter = new NumeroALetras();

            $boletos = [];

            for($i = 0; $i < $numBoletos; $i++){

                // Registrar boleto
                $boleto = $this->controller->__invoke($request);

                // Registrar comprobante
                $comprobante = $this->controllerComprobante->__invoke($request, $boleto);

                // Generar el QR usado el id del boleto
                $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(80)->errorCorrection('L')->generate(
                    $boleto->getId()->value()
                ));

                $item = (Object)[
                    'boleto' => $boleto,
                    'comprobante' => $comprobante,
                    'qrcode' => $qrcode
                ];
                $boletos[] = $item;

            }

            DB::commit();

            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boletos', 'configuracion', 'usuario', 'formatter'))
                ->setPaper(array( 0 , 0 , 226.77 , 226.77 ), 'landscape')
                ->setOption( ['dpi' => 70, 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true] );
            $page_count = $pdf->getCanvas()->get_page_number();

//            dd($pdf->getCanvas( ));
            unset( $pdf );
            $pdf = PDF::loadView('comprobantes.boleta-electronica', compact('boletos', 'configuracion', 'usuario', 'formatter'))
                ->setPaper(array( 0 , 0 , 226.77 * $page_count + 200 , 226.77 ), 'landscape')
                ->setOption( ['dpi' => 70, 'isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true] );



            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output(['Attachment' => 0])),
                'trace' => null,
//                'dd' => $pdf->getCanvas( ),
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            DB::rollBack();

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $request->debug ? $e->getTrace() : null,
//                'd' => $page_count,
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            DB::rollBack();

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $request->debug ? $e->getTrace() : null,
                'status' => $e->getCode()
            ]);

        }
    }
}
