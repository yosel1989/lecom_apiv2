<?php

namespace App\Http\Controllers\Api\VehicleTicketing\Zbus\Ticket;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RegistrarBoletoPorPlacaController extends Controller
{
    /**
     * @var \Src\VehicleTicketing\Ticket\Infraestructure\RegistrarBoletoPorPlacaController
     */
    private $controller;

    public function __construct(\Src\VehicleTicketing\Ticket\Infraestructure\RegistrarBoletoPorPlacaController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            $this->controller->__invoke( $request ) ;
            return response()->json(
//                Response::HTTP_CREATED
                [
                'data' => [],
                'message' =>  [],
                'status' => Response::HTTP_CREATED
                ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json(
//                Response::HTTP_NOT_FOUND
                [
                'data' => [],
                'message' => 'Model not found ',
                'status' => Response::HTTP_NOT_FOUND
            ]
            );

        }catch ( InvalidArgumentException $e ){
            return response()->json(
//                Response::HTTP_BAD_REQUEST
                [
                'data' => [],
                'message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }
        catch ( Exception $e ){
            return response()->json(
//                $e->getCode()
            [
            'data' => null,
            'message' => $e->getMessage(),
            'status' => $e->getCode()
        ]);
        }

    }
}
