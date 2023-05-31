<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketMachine\TicketMachineResource2;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketMachine\Infraestructure\GetCollectionByClientController
     */
    private $controller;

    public function __construct(\Src\VehicleTicketing\TicketMachine\Infraestructure\GetCollectionByClientController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {

            $collection = TicketMachineResource2::collection($this->controller->__invoke($request));
//            $collection = TicketMachine::with('vehicle','userCreated','userUpdated')->where('id_client', $request->id)->get();

            return response()->json([
                'data' => $collection ,
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => [],
                'message' => 'TicketMachine not found ' . $request->id,
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage() . $e->getTraceAsString(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(). $e->getTraceAsString(),
                'status' => $e->getCode()
            ]);

        }
    }
}
