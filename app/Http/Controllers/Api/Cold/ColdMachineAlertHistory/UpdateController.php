<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineAlertHistory;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineAlertHistory\ColdMachineAlertHistoryResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlertHistory\Infrastructure\UpdateController
     */
    private $updateController;

    public function __construct(\Src\Cold\ColdMachineAlertHistory\Infrastructure\UpdateController $updateController )
    {
        $this->updateController = $updateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = ColdMachineAlertHistoryResource::make( $this->updateController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => "null",
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Cold Machine Alert History not found',
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
