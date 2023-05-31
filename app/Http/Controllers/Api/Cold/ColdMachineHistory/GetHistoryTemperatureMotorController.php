<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineHistory;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineHistory\TemperatureMotorHistoryResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetHistoryTemperatureMotorController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineHistory\Infrastructure\GetHistoryTemperatureMotorController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineHistory\Infrastructure\GetHistoryTemperatureMotorController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $collection = TemperatureMotorHistoryResource::collection( $this->getCollectionController->__invoke( $request ) );
            //$ColdMachineModels = ColdMachineHistory::all();
            return response()->json([
                'data' => $collection,
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
