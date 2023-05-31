<?php


namespace App\Http\Controllers\Api\Admin\VehicleClass;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleClass\VehicleClassResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\VehicleClass\Infrastructure\GetVehicleClassCollectionTrashedController
     */
    private $getVehicleClassCollectionController;

    public function __construct(\Src\Admin\VehicleClass\Infrastructure\GetVehicleClassCollectionTrashedController $getVehicleClassCollectionController )
    {
        $this->getVehicleClassCollectionController = $getVehicleClassCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $brands = VehicleClassResource::collection( $this->getVehicleClassCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $brands,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }
    }
}
