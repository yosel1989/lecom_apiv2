<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketProductionRanckingResource;
use App\Http\Resources\VehicleTicketing\Ticket\TicketResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class GetTicketProductionRanckingOfFleetByDateController extends Controller
{

    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketProductionRanckingOfFleetByDateController
     */
    private $getTicketProductionRanckingOfFleetByDateController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketProductionRanckingOfFleetByDateController $getTicketProductionRanckingOfFleetByDateController)
    {
        $this->getTicketProductionRanckingOfFleetByDateController = $getTicketProductionRanckingOfFleetByDateController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TicketResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {


        try {
            $data = TicketProductionRanckingResource::collection($this->getTicketProductionRanckingOfFleetByDateController->__invoke( $request ));
            return response()->json([
                'body' => [ 'data'=> $data ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);
        }
        catch ( ModelNotFoundException $e ) {

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
