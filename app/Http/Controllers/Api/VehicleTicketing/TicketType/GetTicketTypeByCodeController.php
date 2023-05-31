<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketType;


use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleTicketing\TicketType\TicketTypeResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetTicketTypeByCodeController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeByCodeController
     */
    private $getTicketTypeByCodeController;

    public function __construct(\Src\VehicleTicketing\TicketType\Infraestructure\GetTicketTypeByCodeController $getTicketTypeByCodeController)
    {
        $this->getTicketTypeByCodeController = $getTicketTypeByCodeController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($code)
    {
        try {
            $ticket = new TicketTypeResource($this->getTicketTypeByCodeController->__invoke($code));
            return response()->json([
                'body' => [ 'ticket' => $ticket ],
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'errors' => ['TicketTypeCode '.$code.' not found '],
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
