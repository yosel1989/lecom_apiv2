<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineAlertHistory;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineAlertHistory\ColdMachineAlertHistoryRelationResource;
use App\Http\Resources\Cold\ColdMachineAlertHistory\ColdMachineAlertHistoryResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlertHistory\Infrastructure\GetCollectionByClientController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineAlertHistory\Infrastructure\GetCollectionByClientController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachineAlertHistorys = ColdMachineAlertHistoryRelationResource::collection( $this->getCollectionController->__invoke( $request ) );
            //$ColdMachineAlertHistorys = ColdMachineAlertHistory::all();
            return response()->json([
                'data' => $ColdMachineAlertHistorys,
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
