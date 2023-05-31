<?php


namespace App\Http\Controllers\Api\Admin\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Vehicle\SmallVehicleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionActivedByClientController extends Controller
{

    /**
    * @var \Src\Admin\Vehicle\Infrastructure\GetCollectionActivedByClientController
     */
    private $getVehicleCollectionByClientController;

    public function __construct(\Src\Admin\Vehicle\Infrastructure\GetCollectionActivedByClientController $getVehicleCollectionByClientController )
    {
        $this->getVehicleCollectionByClientController = $getVehicleCollectionByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $vehicles = SmallVehicleResource::collection( $this->getVehicleCollectionByClientController->__invoke( $request ) );
            return response()->json([
                'data' => $vehicles,
                'error' => null,
                'status' => Response::HTTP_OK
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
