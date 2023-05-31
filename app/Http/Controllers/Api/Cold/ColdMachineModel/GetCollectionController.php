<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineModel\ColdMachineModelResource;
use App\Models\Cold\ColdMachineModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineModel\Infrastructure\GetCollectionController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineModel\Infrastructure\GetCollectionController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachineModels = ColdMachineModelResource::collection( $this->getCollectionController->__invoke( $request ) );
            //$ColdMachineModels = ColdMachineModel::all();
            return response()->json([
                'data' => $ColdMachineModels,
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
