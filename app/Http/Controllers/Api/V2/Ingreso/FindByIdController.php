<?php

namespace App\Http\Controllers\Api\V2\Ingreso;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;

class FindByIdController extends Controller
{
    private \Src\V2\Ingreso\Infrastructure\FindByIdController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;

    public function __construct(
        \Src\V2\Ingreso\Infrastructure\FindByIdController $controller,
        \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion,
    )
    {
        $this->controller = $controller;
        $this->controllerConfiguracion = $controllerConfiguracion;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(Ingreso::all());

            $ingreso = $this->controller->__invoke($request);
            $formatter = new NumeroALetras();

            $fechaRegistro = new \DateTime($ingreso->getFechaRegistro()->value());

            // Obtener datos de la empresa
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            $pdf = PDF::loadView('comprobantes.comprobante-ingresos', compact('ingreso', 'configuracion', 'formatter', 'fechaRegistro'))
                ->setOption( 'dpi' , '72' );


            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output(['Attachment' => 0])),
                'trace' => null,
                'status' => Response::HTTP_OK
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
