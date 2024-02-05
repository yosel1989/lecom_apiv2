<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\BoletoInterprovincial\PasajeroResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetPasajerosByVehiculoRangoFechaController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\GetPasajerosByVehiculoRangoFechaController $controller;

    public function __construct(\Src\V2\BoletoInterprovincial\Infrastructure\GetPasajerosByVehiculoRangoFechaController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {


            $collection = PasajeroResource::collection($this->controller->__invoke($request));
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
