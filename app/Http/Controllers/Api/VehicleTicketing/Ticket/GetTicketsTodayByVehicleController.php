<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketsTodayByClientResource;

use App\Http\Resources\VehicleTicketing\Ticket\TicketsTodayByVehicleResource;
use App\Models\VehicleTicketing\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketsTodayByVehicleController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketsTodayByVehicleController
     */
    private $getTicketsTodayByVehicleController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketsTodayByVehicleController $getTicketsTodayByVehicleController )
    {
        $this->getTicketsTodayByVehicleController = $getTicketsTodayByVehicleController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {
        $idVehicle = $request->id;

        try {

            $data = TicketsTodayByVehicleResource::make( $this->getTicketsTodayByVehicleController->__invoke($idVehicle) );

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
