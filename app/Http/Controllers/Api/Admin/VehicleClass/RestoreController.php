<?php


namespace App\Http\Controllers\Api\Admin\VehicleClass;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleClass\VehicleClassResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RestoreController extends Controller
{

    /**
    * @var \Src\Admin\VehicleClass\Infrastructure\RestoreVehicleClassController
     */
    private $restoreVehicleClassController;

    public function __construct(\Src\Admin\VehicleClass\Infrastructure\RestoreVehicleClassController $restoreVehicleClassController )
    {
        $this->restoreVehicleClassController = $restoreVehicleClassController;
    }

    public function __invoke( Request $request )
    {
        try {
            VehicleClassResource::make( $this->restoreVehicleClassController->__invoke( $request ) );
            return response()->json([
                'data' => null,
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
