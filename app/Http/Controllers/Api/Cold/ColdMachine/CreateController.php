<?php


namespace App\Http\Controllers\Api\Cold\ColdMachine;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachine\ColdMachineResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachine\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Cold\ColdMachine\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = ColdMachineResource::make( $this->createController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => "",
                'status' => Response::HTTP_CREATED
            ]);
        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }
    }
}
