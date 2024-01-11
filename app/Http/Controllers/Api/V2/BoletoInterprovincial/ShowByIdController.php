<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\BoletoInterprovincial\BoletoInterprovincialResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use InvalidArgumentException;
use Luecano\NumeroALetras\NumeroALetras;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShowByIdController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\FindByIdController $controller;
    private \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion;

    public function __construct(
        \Src\V2\BoletoInterprovincial\Infrastructure\FindByIdController $controller,
        \Src\V2\ClienteConfiguracion\Infrastructure\FindByIdController $controllerConfiguracion,
    )
    {
        $this->controller = $controller;
        $this->controllerConfiguracion = $controllerConfiguracion;
    }


    public function __invoke(Request $request)
    {
        try {
            $fecha = new \DateTime('now');

            $usuario = Auth::user();
            //return response()->json(BoletoInterprovincial::all());

            $configuracion = $this->controllerConfiguracion->__invoke($request);
            $boleto = $this->controller->__invoke($request);

            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(80)->errorCorrection('L')->generate(
                $boleto->getId()->value()
            ));

            // Creando pdf boleto
            $formatter = new NumeroALetras();
            $pdf = PDF::loadView('comprobantes.ver-boleta-electronica', compact('boleto', 'usuario', 'formatter', 'qrcode', 'fecha', 'configuracion'))
                ->setPaper(array( 0 , 0 , 226.77 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );
            $page_count = $pdf->getCanvas()->get_page_number();

            unset( $pdf );
            $pdf = PDF::loadView('comprobantes.ver-boleta-electronica', compact('boleto', 'usuario', 'formatter', 'qrcode', 'fecha', 'configuracion'))
                ->setPaper(array( 0 , 0 , 226.77 * $page_count + 400 , 226.77 ), 'landscape')->setOption( 'dpi' , '72' );

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
