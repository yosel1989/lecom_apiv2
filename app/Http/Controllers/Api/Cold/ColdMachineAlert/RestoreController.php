<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineAlert;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineAlert\ColdMachineAlertResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RestoreController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlert\Infrastructure\RestoreController
     */
    private $restoreColdMachineAlertController;

    public function __construct(\Src\Cold\ColdMachineAlert\Infrastructure\RestoreController $restoreColdMachineAlertController )
    {
        $this->restoreColdMachineAlertController = $restoreColdMachineAlertController;
    }

    public function __invoke( Request $request )
    {
        try {
            ColdMachineAlertResource::make( $this->restoreColdMachineAlertController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => "",
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
