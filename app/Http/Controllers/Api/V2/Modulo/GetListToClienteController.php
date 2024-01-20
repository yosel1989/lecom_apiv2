<?php

namespace App\Http\Controllers\Api\V2\Modulo;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Modulo\ModuloListToPerfilResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetListToClienteController extends Controller
{
    private \Src\V2\Modulo\Infrastructure\GetListToClienteController $controller;

    public function __construct(\Src\V2\Modulo\Infrastructure\GetListToClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request, string $idCliente)
    {
        try {

            //return response()->json(Modulo::all());

            $collection = ModuloListToPerfilResource::collection($this->controller->__invoke($request, $idCliente));
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
