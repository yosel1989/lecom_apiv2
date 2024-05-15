<?php

namespace App\Http\Controllers\Api\V2\CronogramaSalida;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetAsientosDisponiblesController extends Controller
{
    private \Src\V2\CronogramaSalida\Infrastructure\GetAsientosDisponiblesController $controller;

    public function __construct(\Src\V2\CronogramaSalida\Infrastructure\GetAsientosDisponiblesController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(CronogramaSalida::all());

            $asientosDisponibles = $this->controller->__invoke($request)->value();
            return response()->json([
                'data' => $asientosDisponibles,
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
