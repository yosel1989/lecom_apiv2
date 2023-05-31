<?php


namespace App\Http\Controllers\Api\Cold\ColdMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachine\ColdMachineWithRealTimeResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetRealTimeByClientController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachine\Infrastructure\GetRealTimeByClientController
     */
    private $GetRealTimeByClientController;

    public function __construct(\Src\Cold\ColdMachine\Infrastructure\GetRealTimeByClientController $GetRealTimeByClientController )
    {
        $this->GetRealTimeByClientController = $GetRealTimeByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $ColdMachines = ColdMachineWithRealTimeResource::collection( $this->GetRealTimeByClientController->__invoke( $request ) );
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
