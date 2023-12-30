<?php

namespace App\Http\Controllers\Api\V2\ModuloMenu;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\ModuloMenu\ModuloMenuResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{
    private \Src\V2\ModuloMenu\Infrastructure\GetCollectionController $controller;

    public function __construct(\Src\V2\ModuloMenu\Infrastructure\GetCollectionController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request, int $idModulo)
    {
        try {

            //return response()->json(ModuloMenu::all());

            $collection = ModuloMenuResource::collection($this->controller->__invoke($request, $idModulo));
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
