<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use PDF;

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

            // Creando pdf boleto
            $customPaper = array( 0 , 0 , 226.77 , 226.77 );
            $pdf = PDF::loadView('comprobantes.boleta-electronica', [
                'boleto' => $boleto
            ])->setPaper($customPaper, 'landscape')->set_option( 'dpi' , '72' );;

            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output()),
                'trace' => null,
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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
