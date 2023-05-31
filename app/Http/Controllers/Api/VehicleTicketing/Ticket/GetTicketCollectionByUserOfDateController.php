<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;

use App\Http\Resources\VehicleTicketing\Ticket\TicketsTodayByVehicleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketCollectionByUserOfDateController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketCollectionByUserOfDateController
     */
    private $getTicketCollectionByUserOfDateController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketCollectionByUserOfDateController $getTicketCollectionByUserOfDateController )
    {
        $this->getTicketCollectionByUserOfDateController = $getTicketCollectionByUserOfDateController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {

        try {

            $data = TicketsTodayByVehicleResource::make( $this->getTicketCollectionByUserOfDateController->__invoke( $request ) );

            return response()->json([
                'body' => $data ,
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
