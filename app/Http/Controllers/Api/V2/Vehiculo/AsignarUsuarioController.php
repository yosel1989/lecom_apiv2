<?php

namespace App\Http\Controllers\Api\V2\Vehiculo;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class AsignarUsuarioController extends Controller
{
    private \Src\V2\Vehiculo\Infrastructure\AsignarUsuarioController $controller;

    public function __construct(\Src\V2\Vehiculo\Infrastructure\AsignarUsuarioController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(Vehiculo::all());

            $this->controller->__invoke($request);
            return response()->json([
                'data' => null,
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
