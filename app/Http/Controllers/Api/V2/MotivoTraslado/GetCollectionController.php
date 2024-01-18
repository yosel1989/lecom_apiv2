<?php

namespace App\Http\Controllers\Api\V2\MotivoTraslado;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\MotivoTraslado\MotivoTrasladoResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{
    private \Src\V2\MotivoTraslado\Infrastructure\GetCollectionController $controller;

    public function __construct(\Src\V2\MotivoTraslado\Infrastructure\GetCollectionController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(MotivoTraslado::all());

            $collection = MotivoTrasladoResource::collection($this->controller->__invoke($request));
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
