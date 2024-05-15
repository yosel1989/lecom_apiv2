<?php

namespace App\Http\Controllers\Api\V2\CronogramaSalida;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;

class FindPdfByIdController extends Controller
{
    private \Src\V2\CronogramaSalida\Infrastructure\FindPdfByIdController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;

    public function __construct(
        \Src\V2\CronogramaSalida\Infrastructure\FindPdfByIdController $controller,
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

            $CronogramaSalida = $this->controller->__invoke($request);
            $formatter = new NumeroALetras();

            $fechaRegistro = new \DateTime($CronogramaSalida->getFechaRegistro()->value());

            // Obtener datos de la empresa
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            $pdf = PDF::loadView('comprobantes.ticket-interno-CronogramaSalida', compact('CronogramaSalida', 'configuracion', 'formatter', 'fechaRegistro'))
                ->setPaper(array( 0 , 0 , 226.77 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
            $page_count = $pdf->getCanvas()->get_page_number();

            unset( $pdf );
            $pdf = PDF::loadView('comprobantes.ticket-interno-CronogramaSalida', compact('CronogramaSalida', 'configuracion', 'formatter', 'fechaRegistro'))
                ->setPaper(array( 0 , 0 , 226.77 * $page_count + 100 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );


            return response()->json([
                'data' => base64_encode($pdf->output(['Attachment' => 0])),
                'error' =>  null,
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
