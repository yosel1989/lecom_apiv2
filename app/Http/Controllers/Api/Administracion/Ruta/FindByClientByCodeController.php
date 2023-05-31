<?php


namespace App\Http\Controllers\Api\Administracion\Ruta;

use App\Http\Controllers\Controller;
use App\Http\Resources\Administracion\Ruta\CollectionActivedResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class FindByClientByCodeController extends Controller
{
    /**
     * @var \Src\Administracion\Ruta\Infraestructure\FindByClientByCodeController
     */
    private $controller;

    public function __construct(\Src\Administracion\Ruta\Infraestructure\FindByClientByCodeController $controller)
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

            $data = CollectionActivedResource::make($this->controller->__invoke($request));
            return response()->json([
                'data' => $data,
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
