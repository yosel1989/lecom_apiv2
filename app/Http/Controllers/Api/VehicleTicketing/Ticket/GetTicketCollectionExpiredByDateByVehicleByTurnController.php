<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketResource;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketCollectionExpiredByDateByVehicleByTurnController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketCollectionExpiredByDateByVehicleByTurnController
     */
    private $getTicketCollectionExpiredByDateByVehicleByTurnController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketCollectionExpiredByDateByVehicleByTurnController $getTicketCollectionExpiredByDateByVehicleByTurnController )
    {
        $this->getTicketCollectionExpiredByDateByVehicleByTurnController = $getTicketCollectionExpiredByDateByVehicleByTurnController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {

        try {

            $data = TicketResource::collection( $this->getTicketCollectionExpiredByDateByVehicleByTurnController->__invoke( $request ) );

            return response()->json([
                'body' => ['data' =>$data],
                'errors' =>  [],
                'status' => Response::HTTP_OK
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
