<?php


namespace App\Http\Controllers\Api\Admin\SimCard;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SimCard\SimCardResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Admin\SimCard\Infrastructure\UpdateController
     */
    private $updateController;

    public function __construct(\Src\Admin\SimCard\Infrastructure\UpdateController $updateController )
    {
        $this->updateController = $updateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = SimCardResource::make( $this->updateController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Sim Card not found',
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
