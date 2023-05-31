<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateTicketController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\CreateTicketController
     */
    private $createTicketController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\CreateTicketController $createTicketController )
    {
        $this->createTicketController = $createTicketController;
    }

    public function __invoke( Request $request )
    {
        try {
            $newTicket = new TicketResource( $this->createTicketController->__invoke( $request ) );
            return response()->json([
                'body' => [ 'data' => $newTicket ],
                'errors' =>  [],
                'status' => Response::HTTP_CREATED
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['Model not found '],
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){
            return response()->json([
                'body' => [],
                'errors' => [$e->getMessage()],
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

    }
}
