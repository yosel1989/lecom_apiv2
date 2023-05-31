<?php


namespace App\Http\Controllers\Api\Cold\ColdMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachine\ColdMachineResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachine\Infrastructure\GetCollectionByClientController
     */
    private $GetCollectionByClientController;

    public function __construct(\Src\Cold\ColdMachine\Infrastructure\GetCollectionByClientController $GetCollectionByClientController )
    {
        $this->GetCollectionByClientController = $GetCollectionByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachines = ColdMachineResource::collection( $this->GetCollectionByClientController->__invoke( $request ) );
            return response()->json([
                'data' => $ColdMachines,
                'error' => "",
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
