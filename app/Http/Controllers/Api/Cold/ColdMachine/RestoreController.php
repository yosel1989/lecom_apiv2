<?php


namespace App\Http\Controllers\Api\Cold\ColdMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachine\ColdMachineResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RestoreController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachine\Infrastructure\RestoreController
     */
    private $restoreColdMachineController;

    public function __construct(\Src\Cold\ColdMachine\Infrastructure\RestoreController $restoreColdMachineController )
    {
        $this->restoreColdMachineController = $restoreColdMachineController;
    }

    public function __invoke( Request $request )
    {
        try {
            ColdMachineResource::make( $this->restoreColdMachineController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => "",
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Cold Machine not found',
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
