<?php

namespace App\Http\Controllers\Api\V2\BoletoInterprovincial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\BoletoInterprovincial\BoletoInterprovincialOficialResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetReportePuntoVentaByClienteController extends Controller
{
    private \Src\V2\BoletoInterprovincial\Infrastructure\GetReportePuntoVentaByClienteController $controller;

    public function __construct(\Src\V2\BoletoInterprovincial\Infrastructure\GetReportePuntoVentaByClienteController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request)
    {
        try {

            //return response()->json(BoletoInterprovincial::all());

            $collection = BoletoInterprovincialOficialResource::collection($this->controller->__invoke($request));
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
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);

        }
    }
}
