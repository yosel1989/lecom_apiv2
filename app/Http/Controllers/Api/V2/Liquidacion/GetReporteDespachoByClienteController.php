<?php

namespace App\Http\Controllers\Api\V2\Liquidacion;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Liquidacion\LiquidacionResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetReporteDespachoByClienteController extends Controller
{
    private \Src\V2\Liquidacion\Infrastructure\GetReporteDespachoByClienteController $controller;

    public function __construct(\Src\V2\Liquidacion\Infrastructure\GetReporteDespachoByClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(Liquidacion::all());

            $collection = LiquidacionResource::collection($this->controller->__invoke($request)->all());
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
            ], Response::HTTP_BAD_REQUEST);

        }
    }
}
