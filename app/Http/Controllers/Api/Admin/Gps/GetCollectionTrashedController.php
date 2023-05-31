<?php


namespace App\Http\Controllers\Api\Admin\Gps;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Gps\GpsResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\Gps\Infrastructure\GetCollectionTrashedController
     */
    private $getGpsCollectionController;

    public function __construct(\Src\Admin\Gps\Infrastructure\GetCollectionTrashedController $getGpsCollectionController )
    {
        $this->getGpsCollectionController = $getGpsCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Gpss = GpsResource::collection( $this->getGpsCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $Gpss,
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
