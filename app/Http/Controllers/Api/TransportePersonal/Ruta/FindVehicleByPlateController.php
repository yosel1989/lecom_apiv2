<?php


namespace App\Http\Controllers\Api\TransportePersonal\Ruta;


use App\Http\Controllers\Controller;
use App\Http\Resources\TransportePersonal\Ruta\RutaVehiculoResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class FindVehicleByPlateController extends Controller
{
    /**
     * @var \Src\TransportePersonal\Ruta\Infraestructure\FindVehicleByPlateController
     */
    private $controller;

    public function __construct(\Src\TransportePersonal\Ruta\Infraestructure\FindVehicleByPlateController $controller)
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

//            $this->controller->__invoke($request);
            return response()->json([
                'data' => new RutaVehiculoResource($this->controller->__invoke($request)),
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'message' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
