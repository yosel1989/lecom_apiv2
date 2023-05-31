<?php

namespace App\Http\Controllers\Api\Administracion\PersonalCategoria;

use App\Http\Controllers\Controller;
use App\Http\Resources\Administracion\PersonalCategoria\CollectionResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{
    /**
     * @var \Src\Administracion\PersonalCategoria\Infraestructure\GetCollectionController
     */
    private $controller;

    public function __construct(\Src\Administracion\PersonalCategoria\Infraestructure\GetCollectionController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {

            $collection = CollectionResource::collection($this->controller->__invoke($request));
            return response()->json([
                'data' => $collection,
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
