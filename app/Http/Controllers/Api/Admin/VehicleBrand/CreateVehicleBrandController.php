<?php


namespace App\Http\Controllers\Api\Admin\VehicleBrand;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleBrand\VehicleBrandResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateVehicleBrandController extends Controller
{

    /**
    * @var \Src\Admin\VehicleBrand\Infrastructure\CreateVehicleBrandController
     */
    private $createVehicleBrandController;

    public function __construct(\Src\Admin\VehicleBrand\Infrastructure\CreateVehicleBrandController $createVehicleBrandController )
    {
        $this->createVehicleBrandController = $createVehicleBrandController;
    }

    public function __invoke( Request $request )
    {
        try {
            $brand = VehicleBrandResource::make( $this->createVehicleBrandController->__invoke( $request ) );
            return response()->json([
                'data' => $brand,
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
