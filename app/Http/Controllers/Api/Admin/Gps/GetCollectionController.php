<?php


namespace App\Http\Controllers\Api\Admin\Gps;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Gps\GpsResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Admin\Gps\Infrastructure\GetCollectionController
     */
    private $getCollectionController;

    public function __construct(\Src\Admin\Gps\Infrastructure\GetCollectionController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Gps = GpsResource::collection( $this->getCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $Gps,
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
