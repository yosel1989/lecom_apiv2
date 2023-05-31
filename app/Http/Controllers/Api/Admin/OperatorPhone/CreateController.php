<?php


namespace App\Http\Controllers\Api\Admin\OperatorPhone;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OperatorPhone\OperatorPhoneResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\OperatorPhone\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Admin\OperatorPhone\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $operator = OperatorPhoneResource::make( $this->createController->__invoke( $request ) );
            return response()->json([
                'data' => $operator,
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
