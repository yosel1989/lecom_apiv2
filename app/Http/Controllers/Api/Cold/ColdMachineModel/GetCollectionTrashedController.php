<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineModel\ColdMachineModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineModel\Infrastructure\GetCollectionTrashedController
     */
    private $getCollectionTrashedController;

    public function __construct(\Src\Cold\ColdMachineModel\Infrastructure\GetCollectionTrashedController $getCollectionTrashedController )
    {
        $this->getCollectionTrashedController = $getCollectionTrashedController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachineModels = ColdMachineModelResource::collection( $this->getCollectionTrashedController->__invoke( $request ) );
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
