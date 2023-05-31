<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketPrice;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketPrice\TicketPriceResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketPriceController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketPrice\Infraestructure\GetTicketPriceController
     */
    private $getTicketPriceController;

    public function __construct(\Src\VehicleTicketing\TicketPrice\Infraestructure\GetTicketPriceController $getTicketPriceController)
    {
        $this->getTicketPriceController = $getTicketPriceController;
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

            $ticketPrice = new TicketPriceResource($this->getTicketPriceController->__invoke($request));
            return response()->json([
                'body' => [ 'ticket_price' => $ticketPrice ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['TicketPrice not found ' . $request->id],
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
