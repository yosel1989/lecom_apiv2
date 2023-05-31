<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineHistory;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineHistory\LevelFuelHistoryResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetHistoryLevelFuelController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineHistory\Infrastructure\GetHistoryLevelFuelController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineHistory\Infrastructure\GetHistoryLevelFuelController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $collection = LevelFuelHistoryResource::collection( $this->getCollectionController->__invoke( $request ) );
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
