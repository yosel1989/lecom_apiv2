<?php


namespace App\Http\Controllers\Api\Admin\VehicleModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleModel\VehicleModelResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TrashVehicleModelController extends Controller
{

    /**
    * @var \Src\Admin\VehicleModel\Infrastructure\TrashVehicleModelController
     */
    private $trashVehicleModelController;

    public function __construct(\Src\Admin\VehicleModel\Infrastructure\TrashVehicleModelController $trashVehicleModelController )
    {
        $this->trashVehicleModelController = $trashVehicleModelController;
    }

    public function __invoke( Request $request )
    {
        try {
            VehicleModelResource::make( $this->trashVehicleModelController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Vehicle model not found',
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
