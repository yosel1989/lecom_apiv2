<?php

namespace App\Http\Controllers\Api\TransportePersonal\Ruta;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class AssignPointsController extends Controller
{
    /**
     * @var \Src\TransportePersonal\Ruta\Infraestructure\AssignPointsController
     */
    private $controller;

    public function __construct(\Src\TransportePersonal\Ruta\Infraestructure\AssignPointsController $controller)
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
//            return response()->json($request);
            $this->controller->__invoke($request);
            return response()->json([
                'data' => [],
                'message' =>  "",
                'status' => Response::HTTP_CREATED
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
