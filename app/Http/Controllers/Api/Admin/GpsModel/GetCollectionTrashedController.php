<?php


namespace App\Http\Controllers\Api\Admin\GpsModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GpsModel\GpsModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\GpsModel\Infrastructure\GetCollectionTrashedController
     */
    private $getGpsModelCollectionController;

    public function __construct(\Src\Admin\GpsModel\Infrastructure\GetCollectionTrashedController $getGpsModelCollectionController )
    {
        $this->getGpsModelCollectionController = $getGpsModelCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $gpsModels = GpsModelResource::collection( $this->getGpsModelCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $gpsModels,
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
