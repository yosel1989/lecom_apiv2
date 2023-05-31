<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketPrice;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketPrice\TicketPriceResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketPriceByCriteriaController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketPrice\Infraestructure\GetTicketPriceByCriteriaController
     */
    private $getTicketPriceByCriteriaController;

    public function __construct( \Src\VehicleTicketing\TicketPrice\Infraestructure\GetTicketPriceByCriteriaController $getTicketPriceByCriteriaController )
    {
        $this->getTicketPriceByCriteriaController = $getTicketPriceByCriteriaController;
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
            $ticketPrice = new TicketPriceResource($this->getTicketPriceByCriteriaController->__invoke( $request ));
            return response()->json([
                'body' => [ 'ticket_price' => $ticketPrice ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['TicketPrice price '.$request->code.' with id client '.$request->idClient.' not found '],
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
