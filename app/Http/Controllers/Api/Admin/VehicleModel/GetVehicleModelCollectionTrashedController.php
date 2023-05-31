<?php


namespace App\Http\Controllers\Api\Admin\VehicleModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleModel\VehicleModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetVehicleModelCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\VehicleModel\Infrastructure\GetVehicleModelCollectionTrashedController
     */
    private $getVehicleModelCollectionController;

    public function __construct(\Src\Admin\VehicleModel\Infrastructure\GetVehicleModelCollectionTrashedController $getVehicleModelCollectionController )
    {
        $this->getVehicleModelCollectionController = $getVehicleModelCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $brands = VehicleModelResource::collection( $this->getVehicleModelCollectionController->__invoke( $request ) );
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
