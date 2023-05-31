<?php


namespace App\Http\Controllers\Api\Admin\OperatorPhone;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OperatorPhone\OperatorPhoneResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class DeleteController extends Controller
{

    /**
    * @var \Src\Admin\OperatorPhone\Infrastructure\DeleteController
     */
    private $deleteController;

    public function __construct(\Src\Admin\OperatorPhone\Infrastructure\DeleteController $deleteController )
    {
        $this->deleteController = $deleteController;
    }

    public function __invoke( Request $request )
    {
        try {
            OperatorPhoneResource::make( $this->deleteController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Operator phone not found',
                'status' => Response::HTTP_NOT_FOUND
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
