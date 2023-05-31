<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketByVehicleByDateResource;
use App\Http\Resources\VehicleTicketing\Ticket\TicketsTodayByVehicleResource;
use App\Models\VehicleTicketing\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketsReportByVehicleDateController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketsReportByVehicleDateController
     */
    private $getTicketsReportByVehicleDateController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketsReportByVehicleDateController $getTicketsReportByVehicleDateController )
    {
        $this->getTicketsReportByVehicleDateController = $getTicketsReportByVehicleDateController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {

        try {

            $data = TicketByVehicleByDateResource::collection( $this->getTicketsReportByVehicleDateController->__invoke($request) );

            return response()->json([
                'data' => $data ,
                'message' =>  null,
                'status' => Response::HTTP_OK
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
