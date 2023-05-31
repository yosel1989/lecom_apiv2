<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Report;


use App\Http\Controllers\Controller;

use App\Http\Resources\VehicleTicketing\Report\TotalAverageByFleetHourResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use DB;
use Src\VehicleTicketing\Report\Infraestructure\TotalAverageByFleetHourController;

class GetTotalAverageByFleetHourController extends Controller
{
    private $controller;

    public function __construct(TotalAverageByFleetHourController $controller )
    {
        $this->controller = $controller;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request

     */
    public function __invoke(Request $request)
    {

        try {

            $data = TotalAverageByFleetHourResource::collection( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => $data,
                'errors' =>  [],
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'errors' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'errors' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
