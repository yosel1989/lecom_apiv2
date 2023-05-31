<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineAlert;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineAlert\ColdMachineAlertResource;
use App\Models\Cold\ColdMachineAlert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlert\Infrastructure\GetCollectionController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineAlert\Infrastructure\GetCollectionController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachineAlerts = ColdMachineAlertResource::collection( $this->getCollectionController->__invoke( $request ) );
            //$ColdMachineAlerts = ColdMachineAlert::all();
            return response()->json([
                'data' => $ColdMachineAlerts,
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
