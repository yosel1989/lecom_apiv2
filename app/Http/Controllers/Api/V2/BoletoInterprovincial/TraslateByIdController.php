<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TraslateByIdController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\TraslateByIdController $controller;

    public function __construct(\Src\V2\BoletoInterprovincial\Infrastructure\TraslateByIdController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(BoletoInterprovincial::all());

            $this->controller->__invoke($request);
            return response()->json([
                'data' => true,
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
