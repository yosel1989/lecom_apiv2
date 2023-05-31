<?php


namespace App\Http\Controllers\Api\VehicleTicketing\Ticket;


use App\Exports\Ticket\TicketExport;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Maatwebsite\Excel\Facades\Excel;

class ExportTicketsReportByVehicleDateController extends Controller
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
     *
     */
    public function __invoke(Request $request)
    {

        try {

            $data =  $this->getTicketsReportByVehicleDateController->__invoke($request);
            $start = $request->input('start');
            $end = $request->input('end');
            return Excel::download(new TicketExport($data,$start,$end), "Reporte boletaje {$start} hasta {$end}.xlsx", null, [\Maatwebsite\Excel\Excel::XLSX]);
            /*return response()->json([
                'data' => $excel,
                'error' =>  null,
                'status' => Response::HTTP_OK
            ]);*/

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
