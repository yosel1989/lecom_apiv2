<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketMachine;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketMachine\Infraestructure\CreateController
     */
    private $controller;

    public function __construct(\Src\VehicleTicketing\TicketMachine\Infraestructure\CreateController $getTicketMachineController)
    {
        $this->getTicketMachineController = $getTicketMachineController;
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

            $this->getTicketMachineController->__invoke($request);
            return response()->json([
                'data' => [],
                'message' =>  "",
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
