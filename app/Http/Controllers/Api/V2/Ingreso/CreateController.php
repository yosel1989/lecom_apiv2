<?php

namespace App\Http\Controllers\Api\V2\Ingreso;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateController extends Controller
{
    private \Src\V2\Ingreso\Infrastructure\CreateController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;

    public function __construct(
        \Src\V2\Ingreso\Infrastructure\CreateController $controller,
        \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion,
    )
    {
        $this->controller = $controller;
        $this->controllerConfiguracion = $controllerConfiguracion;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $usuario = Auth::user();

            $ingreso = $this->controller->__invoke($request);
            $formatter = new NumeroALetras();

            $fechaRegistro = new \DateTime($ingreso->getFechaRegistro()->value());

            // Obtener datos de la empresa
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            $pdf = PDF::loadView('comprobantes.comprobante-ingresos', compact('ingreso', 'configuracion', 'usuario', 'formatter', 'fechaRegistro'))
                ->setOption( 'dpi' , '72' );

            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output(['Attachment' => 0])),
                'trace' => null,
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'trace' => $e->getTrace(),
                'status' => ResponseAlias::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'trace' => $e->getTrace(),
                'status' => $e->getCode()
            ]);

        }
    }
}
