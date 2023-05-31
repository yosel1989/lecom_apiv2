<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketType;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketType\TicketTypeResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketTypeCollectionController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeCollectionController
     */
    private $getTicketTypeCollectionController;

    public function __construct(\Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeCollectionController $getTicketTypeCollectionController)
    {
        $this->getTicketTypeCollectionController = $getTicketTypeCollectionController;
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

            $ticketType = TicketTypeResource::collection($this->getTicketTypeCollectionController->__invoke($request));
            return response()->json([
                'data' => $ticketType ,
                'error' => "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Ticket not found ' . $request->id,
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
