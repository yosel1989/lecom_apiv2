<?php

namespace App\Http\Controllers\Api\V2\EgresoDetalle;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\EgresoDetalle\EgresoDetalleReporteResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetReporteByClienteController extends Controller
{
    private \Src\V2\EgresoDetalle\Infrastructure\GetReporteByClienteController $controller;

    public function __construct(\Src\V2\EgresoDetalle\Infrastructure\GetReporteByClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(EgresoDetalle::all());

            $collection = EgresoDetalleReporteResource::collection($this->controller->__invoke($request)->all());
            return response()->json([
                'data' => $collection,
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
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }
    }
}
