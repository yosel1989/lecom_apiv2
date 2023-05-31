<?php


namespace App\Http\Controllers\Api\Admin\VehicleBrand;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleBrand\VehicleBrandResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetVehicleBrandCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\VehicleBrand\Infrastructure\GetVehicleBrandCollectionTrashedController
     */
    private $getVehicleBrandCollectionController;

    public function __construct(\Src\Admin\VehicleBrand\Infrastructure\GetVehicleBrandCollectionTrashedController $getVehicleBrandCollectionController )
    {
        $this->getVehicleBrandCollectionController = $getVehicleBrandCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $brands = VehicleBrandResource::collection( $this->getVehicleBrandCollectionController->__invoke( $request ) );
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
