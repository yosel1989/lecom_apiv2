<?php


namespace App\Http\Controllers\Api\Admin\VehicleClass;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleClass\VehicleClassResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\VehicleClass\Infrastructure\CreateVehicleClassController
     */
    private $createVehicleClassController;

    public function __construct(\Src\Admin\VehicleClass\Infrastructure\CreateVehicleClassController $createVehicleClassController )
    {
        $this->createVehicleClassController = $createVehicleClassController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = VehicleClassResource::make( $this->createVehicleClassController->__invoke( $request ) );
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
