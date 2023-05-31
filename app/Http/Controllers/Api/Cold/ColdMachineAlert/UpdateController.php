<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineAlert;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineAlert\ColdMachineAlertResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlert\Infrastructure\UpdateController
     */
    private $updateController;

    public function __construct(\Src\Cold\ColdMachineAlert\Infrastructure\UpdateController $updateController )
    {
        $this->updateController = $updateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = ColdMachineAlertResource::make( $this->updateController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => "null",
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Cold Machine Alert not found',
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
