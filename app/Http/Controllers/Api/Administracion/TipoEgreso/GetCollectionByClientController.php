<?php

namespace App\Http\Controllers\Api\Administracion\TipoEgreso;

use App\Http\Controllers\Controller;
use App\Http\Resources\Administracion\TipoEgreso\CollectionResource;
use App\Models\Administracion\TipoEgreso;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{
    /**
     * @var \Src\Administracion\TipoEgreso\Infraestructure\GetCollectionByClientController
     */
    private $controller;

    public function __construct(\Src\Administracion\TipoEgreso\Infraestructure\GetCollectionByClientController $controller)
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

//            return response()->json(
//                TipoEgreso::with('userCreated:id,first_name,last_name','userUpdated:id,first_name,last_name')
//                    ->where('id_client',$request->id)
//                    ->get()
//            );
            $collection = CollectionResource::collection($this->controller->__invoke($request));
            return response()->json([
                'data' => $collection,
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage() . " : " . $e->getTraceAsString(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage() . " : " . $e->getTraceAsString(),
                'status' => $e->getCode()
            ]);

        }
    }
}
