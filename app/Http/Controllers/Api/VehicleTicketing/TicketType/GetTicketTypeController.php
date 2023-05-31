<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketType;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketType\TicketTypeResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketTypeController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeController
     */
    private $getTicketTypeController;

    public function __construct(\Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeController $getTicketTypeController)
    {
        $this->getTicketTypeController = $getTicketTypeController;
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

            $ticketType = new TicketTypeResource($this->getTicketTypeController->__invoke($request));
            return response()->json([
                'body' => [ 'ticket_type' => $ticketType ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['Ticket not found ' . $request->id],
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
