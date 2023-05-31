<?php


namespace App\Http\Controllers\Api\Admin\VehicleModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleModel\VehicleModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByBrandController extends Controller
{

    /**
    * @var \Src\Admin\VehicleModel\Infrastructure\GetCollectionByBrandController
     */
    private $getCollectionByBrandController;

    public function __construct(\Src\Admin\VehicleModel\Infrastructure\GetCollectionByBrandController $getCollectionByBrandController )
    {
        $this->getCollectionByBrandController = $getCollectionByBrandController;
    }

    public function __invoke( Request $request )
    {
        try {
            $models = VehicleModelResource::collection( $this->getCollectionByBrandController->__invoke( $request ) );
            return response()->json([
                'data' => $models,
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
