<?php


namespace App\Http\Controllers\Api\Admin\Gps;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Gps\GpsResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\Gps\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Admin\Gps\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Gps = GpsResource::make( $this->createController->__invoke( $request ) );
            return response()->json([
                'data' => $Gps,
                'error' => null,
                'status' => Response::HTTP_CREATED
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
