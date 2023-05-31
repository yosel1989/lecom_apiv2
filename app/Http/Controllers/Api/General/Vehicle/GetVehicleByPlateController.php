<?php


namespace App\Http\Controllers\Api\General\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\General\Vehicle\VehicleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetVehicleByPlateController extends Controller
{
    /**
     * @var \Src\General\Vehicle\Infrastructure\GetVehicleByPlateController
     */
    private $GetVehicleByPlateController;

    public function __construct(\Src\General\Vehicle\Infrastructure\GetVehicleByPlateController $GetVehicleByPlateController)
    {
        $this->GetVehicleByPlateController = $GetVehicleByPlateController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VehicleResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {

            $data = VehicleResource::make($this->GetVehicleByPlateController->__invoke($request));

            return response()->json([
                'data'      => $data,
                'message'    => '',
                'status'    => Response::HTTP_OK
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
