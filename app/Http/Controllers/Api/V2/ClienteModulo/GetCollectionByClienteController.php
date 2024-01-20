<?php

namespace App\Http\Controllers\Api\V2\ClienteModulo;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\ClienteModulo\ClienteModuloResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClienteController extends Controller
{
    private \Src\V2\ClienteModulo\Infrastructure\GetCollectionByClienteController $controller;

    public function __construct(\Src\V2\ClienteModulo\Infrastructure\GetCollectionByClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(ClienteModulo::all());

            $collection = ClienteModuloResource::collection($this->controller->__invoke($request));
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
