<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineHistory;

use App\Events\AlertColdMachineHistoryEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineHistory\ColdMachineHistoryResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;


class CreateController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineHistory\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Cold\ColdMachineHistory\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $response = ColdMachineHistoryResource::make( $this->createController->__invoke( $request ) );

            //broadcast(new AlertColdMachineEvent("ffff"))->toOthers();
            return response()->json(201);
            /*return response()->json([
                'data' => $response,
                'error' => null,
                'status' => Response::HTTP_CREATED
            ]);*/
        }catch ( InvalidArgumentException | Exception $e ){
            //return response()->json(400);
            return response()->json([
                'data' => $request->all(),
                'error' => $e->getMessage(),
                'status' => $e->getTraceAsString()
            ],400);
        }
    }
}
