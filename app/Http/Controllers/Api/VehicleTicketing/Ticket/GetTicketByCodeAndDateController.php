<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\Ticket\TicketResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketByCodeAndDateController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\GetTicketByCodeAndDateController
     */
    private $getTicketByCodeAndDateController;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\GetTicketByCodeAndDateController $getTicketByCodeAndDateController )
    {
        $this->getTicketByCodeAndDateController = $getTicketByCodeAndDateController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {
        $code = $request->input('code');
        $date = $request->input('date');

        try {

            $data = TicketResource::make( $this->getTicketByCodeAndDateController->__invoke($code,$date) );

            return response()->json([
                'data' => $data ,
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'errors' => [$e->getMessage()],
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'errors' => [$e->getMessage()],
                'status' => $e->getCode()
            ]);

        }
    }
}
