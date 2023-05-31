<?php


namespace App\Http\Controllers\Api\Cold\ColdMachineModel;


use App\Http\Controllers\Controller;
use App\Http\Resources\Cold\ColdMachineModel\ColdMachineModelResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineModel\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Cold\ColdMachineModel\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $model = ColdMachineModelResource::make( $this->createController->__invoke( $request ) );
            return response()->json([
                'data' => $model,
                'error' => null,
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
