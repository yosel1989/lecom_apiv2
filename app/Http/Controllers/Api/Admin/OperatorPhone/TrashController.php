<?php


namespace App\Http\Controllers\Api\Admin\OperatorPhone;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OperatorPhone\OperatorPhoneResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TrashController extends Controller
{

    /**
    * @var \Src\Admin\OperatorPhone\Infrastructure\TrashController
     */
    private $trashController;

    public function __construct(\Src\Admin\OperatorPhone\Infrastructure\TrashController $trashController )
    {
        $this->trashController = $trashController;
    }

    public function __invoke( Request $request )
    {
        try {
            OperatorPhoneResource::make( $this->trashController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Operator Phone not found',
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
