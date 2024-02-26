<?php

namespace App\Http\Controllers\Api\V2\IngresoTipo;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\IngresoTipo\IngresoTipoListResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetListByClienteController extends Controller
{
    private \Src\V2\IngresoTipo\Infrastructure\GetListByClienteController $controller;

    public function __construct(\Src\V2\IngresoTipo\Infrastructure\GetListByClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(IngresoTipo::all());

            $collection = IngresoTipoListResource::collection($this->controller->__invoke($request)->all());
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
                'status' => $e->getCode()
            ]);

        }
    }
}
