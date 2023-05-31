<?php


namespace App\Http\Controllers\Api\Admin\TypePay;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TypePay\TypePayResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\TypePay\Infrastructure\CreateController
     */
    private $createController;

    public function __construct(\Src\Admin\TypePay\Infrastructure\CreateController $createController )
    {
        $this->createController = $createController;
    }

    public function __invoke( Request $request )
    {
        try {
            $type = TypePayResource::make( $this->createController->__invoke( $request ) );
            return response()->json([
                'data' => $type,
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
