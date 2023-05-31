<?php


namespace App\Http\Controllers\Api\General\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\General\Vehicle\VehiclesResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class GetVehiclesByUserController extends Controller
{
    /**
     * @var \Src\General\Vehicle\Infrastructure\GetVehiclesByUserController
     */
    private $getVehiclesByUserController;

    public function __construct(\Src\General\Vehicle\Infrastructure\GetVehiclesByUserController $getVehiclesByUserController)
    {
        $this->getVehiclesByUserController = $getVehiclesByUserController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VehiclesResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $idUser = Auth::user()->id;

        try {

            $data = VehiclesResource::make($this->getVehiclesByUserController->__invoke($idUser));

            return response()->json([
                'body'      => $data,
                'errors'    => [],
                'status'    => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'body' => [],
                'errors' => [$e->getMessage()],
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'body' => [],
                'errors' => [$e->getMessage()],
                'status' => $e->getCode()
            ]);

        }
    }
}
