<?php


namespace App\Http\Controllers\Api\V2\Egreso;


use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateController extends Controller
{
    private \Src\V2\Egreso\Infrastructure\CreateController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;

    public function __construct(
        \Src\V2\Egreso\Infrastructure\CreateController $controller,
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

//            return response()->json($id);

            $egreso = $this->controller->__invoke($request);
            $formatter = new NumeroALetras();
            $fechaRegistro = new \DateTime($egreso->getFechaRegistro()->value());

            // Obtener datos de la empresa
            $configuracion = $this->controllerConfiguracion->__invoke($request);

            $pdf = PDF::loadView('comprobantes.ticket-interno-egreso', compact('egreso', 'configuracion', 'formatter', 'fechaRegistro'))
                ->setOption( 'dpi' , '72' );

            return response()->json([
                'data' => null,
                'error' =>  null,
                'pdf' => base64_encode($pdf->output(['Attachment' => 0])),
                'status' => ResponseAlias::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => ResponseAlias::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
