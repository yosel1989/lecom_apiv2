<?php


namespace App\Http\Controllers\Api\General\Vehicle;


use App\Http\Controllers\Controller;
use App\Http\Resources\General\Vehicle\VehicleResource;
use App\Http\Resources\VehicleTicketing\Ticket\TicketResource;
use App\Models\VehicleTicketing\Ticket;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetVehicleController extends Controller
{
    /**
     * @var \Src\General\Vehicle\Infrastructure\GetVehicleController
     */
    private $getVehicleController;

    public function __construct(\Src\General\Vehicle\Infrastructure\GetVehicleController $getVehicleController)
    {
        $this->getVehicleController = $getVehicleController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VehicleResource|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return VehicleResource::make($this->getVehicleController->__invoke($request));
    }
}
