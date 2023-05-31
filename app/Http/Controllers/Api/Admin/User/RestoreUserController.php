<?php


namespace App\Http\Controllers\Api\Admin\User;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RestoreUserController extends Controller
{

    /**
    * @var \Src\Admin\User\Infraestructure\RestoreUserController
     */
    private $restoreUserController;

    public function __construct(\Src\Admin\User\Infraestructure\RestoreUserController $restoreUserController )
    {
        $this->restoreUserController = $restoreUserController;
    }

    public function __invoke( Request $request )
    {
        try {
            $this->restoreUserController->__invoke( $request );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'User not found',
                'status' => Response::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

    }
}
