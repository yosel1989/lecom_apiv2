<?php


namespace App\Http\Controllers\Api\Admin\GpsModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GpsModel\GpsModelResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Admin\GpsModel\Infrastructure\UpdateController
     */
    private $updateController;

    public function __construct(\Src\Admin\GpsModel\Infrastructure\UpdateController $updateController )
    {
        $this->updateController = $updateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $gpsModel = GpsModelResource::make( $this->updateController->__invoke( $request ) );
            return response()->json([
                'data' => $gpsModel,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Gps Model not found',
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
