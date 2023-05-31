<?php


namespace App\Http\Controllers\Api\Admin\VehicleModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleModel\VehicleModelResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateVehicleModelController extends Controller
{

    /**
    * @var \Src\Admin\VehicleModel\Infrastructure\UpdateVehicleModelController
     */
    private $updateVehicleModelController;

    public function __construct(\Src\Admin\VehicleModel\Infrastructure\UpdateVehicleModelController $updateVehicleModelController )
    {
        $this->updateVehicleModelController = $updateVehicleModelController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = VehicleModelResource::make( $this->updateVehicleModelController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Vehicle Brand not found',
                'status' => Response::HTTP_NOT_FOUND
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
