<?php


namespace App\Http\Controllers\Api\Admin\VehicleClass;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleClass\VehicleClassResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Admin\VehicleClass\Infrastructure\UpdateVehicleClassController
     */
    private $updateVehicleClassController;

    public function __construct(\Src\Admin\VehicleClass\Infrastructure\UpdateVehicleClassController $updateVehicleClassController )
    {
        $this->updateVehicleClassController = $updateVehicleClassController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = VehicleClassResource::make( $this->updateVehicleClassController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Vehicle class not found',
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
