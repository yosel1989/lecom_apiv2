<?php


namespace App\Http\Controllers\Api\VehicleTicketing\TicketMachine;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class UpdateController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\TicketMachine\Infraestructure\UpdateController
     */
    private $controller;

    public function __construct(\Src\VehicleTicketing\TicketMachine\Infraestructure\UpdateController $controller)
    {
        $this->controller = $controller;
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

            $this->controller->__invoke($request);
            return response()->json([
                'data' => [] ,
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'body' => [],
                'message' => 'TicketMachine not found ' . $request->id,
                'status' => Response::HTTP_NOT_FOUND
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
