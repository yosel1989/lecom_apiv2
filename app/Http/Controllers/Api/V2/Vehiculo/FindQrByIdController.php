<?php

namespace App\Http\Controllers\Api\V2\Vehiculo;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Vehiculo\VehiculoResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FindQrByIdController extends Controller
{
    private \Src\V2\Vehiculo\Infrastructure\FindByIdController $controller;

    public function __construct(\Src\V2\Vehiculo\Infrastructure\FindByIdController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            $vehicle = VehiculoResource::make($this->controller->__invoke($request));

            $qrcode = base64_encode(QrCode::encoding('UTF-8')->format('svg')->size(800)->errorCorrection('L')->generate(
                $vehicle->getId()->value()
            ));

            $pdf = PDF::loadView('archivos.qr-vehiculo', compact('qrcode', 'vehicle'))
                ->setPaper('A4', 'landscape');

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
