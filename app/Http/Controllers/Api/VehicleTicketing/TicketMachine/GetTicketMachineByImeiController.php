<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketMachine\TicketMachineResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketMachineByImeiController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketMachine\Infraestructure\GetTicketMachineByImeiController
     */
    private $getTicketMachineByImeiController;

    public function __construct( \Src\VehicleTicketing\TicketMachine\Infraestructure\GetTicketMachineByImeiController $getTicketMachineByImeiController )
    {
        $this->getTicketMachineByImeiController = $getTicketMachineByImeiController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke( Request $request )
    {
        try {
            $ticketMachine = new TicketMachineResource($this->getTicketMachineByImeiController->__invoke( $request ));
            return response()->json([
                'body' => [ 'ticket_machine' => $ticketMachine ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['TicketMachine imei '.$request->imei.' not found '],
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'body' => [],
                'errors' => [$e->getMessage()],
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){
            return response()->json([
                'body' => [],
                'errors' => [$e->getMessage()],
                'status' => $e->getCode()
            ]);

        }
    }
}
