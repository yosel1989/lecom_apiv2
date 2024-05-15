<?php

namespace App\Http\Controllers\Api\V2\Egreso;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Egreso\EgresoResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class FindByIdController extends Controller
{
    private \Src\V2\Egreso\Infrastructure\FindByIdController $controller;

    public function __construct(\Src\V2\Egreso\Infrastructure\FindByIdController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(Egreso::all());

            $vehicle = EgresoResource::make($this->controller->__invoke($request));
            return response()->json([
                'data' => $vehicle,
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
