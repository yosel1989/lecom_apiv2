<?php


namespace App\Http\Controllers\Api\Admin\VehicleModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleModel\VehicleModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateVehicleModelController extends Controller
{

    /**
    * @var \Src\Admin\VehicleModel\Infrastructure\CreateVehicleModelController
     */
    private $createVehicleModelController;

    public function __construct(\Src\Admin\VehicleModel\Infrastructure\CreateVehicleModelController $createVehicleModelController )
    {
        $this->createVehicleModelController = $createVehicleModelController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = VehicleModelResource::make( $this->createVehicleModelController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => null,
                'status' => Response::HTTP_CREATED
            ]);
        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }
    }
}
