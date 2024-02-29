<?php

namespace App\Http\Controllers\Api\V2\EntidadFinanciera;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\EntidadFinanciera\EntidadFinancieraResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetListController extends Controller
{
    private \Src\V2\EntidadFinanciera\Infrastructure\GetCollectionByEstadoController $controller;

    public function __construct(\Src\V2\EntidadFinanciera\Infrastructure\GetCollectionByEstadoController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(EntidadFinanciera::all());

            $collection = EntidadFinancieraResource::collection($this->controller->__invoke($request)->all());
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
