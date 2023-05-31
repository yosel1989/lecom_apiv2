<?php


namespace App\Http\Controllers\Api\Admin\GpsModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GpsModel\GpsModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Admin\GpsModel\Infrastructure\GetCollectionController
     */
    private $getCollectionController;

    public function __construct(\Src\Admin\GpsModel\Infrastructure\GetCollectionController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $gpsModel = GpsModelResource::collection( $this->getCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $gpsModel,
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
