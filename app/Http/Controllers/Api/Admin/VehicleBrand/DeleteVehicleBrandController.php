<?php


namespace App\Http\Controllers\Api\Admin\VehicleBrand;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleBrand\VehicleBrandResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class DeleteVehicleBrandController extends Controller
{

    /**
    * @var \Src\Admin\VehicleBrand\Infrastructure\DeleteVehicleBrandController
     */
    private $deleteVehicleBrandController;

    public function __construct(\Src\Admin\VehicleBrand\Infrastructure\DeleteVehicleBrandController $deleteVehicleBrandController )
    {
        $this->deleteVehicleBrandController = $deleteVehicleBrandController;
    }

    public function __invoke( Request $request )
    {
        try {
            VehicleBrandResource::make( $this->deleteVehicleBrandController->__invoke( $request ) );
            return response()->json([
                'data' => null,
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
