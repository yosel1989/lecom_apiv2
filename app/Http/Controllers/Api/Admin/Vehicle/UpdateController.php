<?php


namespace App\Http\Controllers\Api\Admin\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Vehicle\VehicleResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Admin\Vehicle\Infrastructure\UpdateController
     */
    private $updateController;

    public function __construct(\Src\Admin\Vehicle\Infrastructure\UpdateController $updateController )
    {
        $this->updateController = $updateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Vehicle = VehicleResource::make( $this->updateController->__invoke( $request ) );
            return response()->json([
                'data' => $Vehicle,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Vehicle not found',
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
