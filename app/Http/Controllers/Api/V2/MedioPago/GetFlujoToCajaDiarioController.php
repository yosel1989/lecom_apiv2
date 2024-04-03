<?php

namespace App\Http\Controllers\Api\V2\MedioPago;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\MedioPago\MedioPagoCajaDiarioResource;
use App\Http\Resources\V2\MedioPago\MedioPagoFlujoResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetFlujoToCajaDiarioController extends Controller
{
    private \Src\V2\MedioPago\Infrastructure\GetFlujoToCajaDiarioController $controller;

    public function __construct(\Src\V2\MedioPago\Infrastructure\GetFlujoToCajaDiarioController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(MedioPago::all());

            $output = MedioPagoFlujoResource::make($this->controller->__invoke($request));
            return response()->json([
                'data' => $output,
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
