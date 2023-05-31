<?php


namespace App\Http\Controllers\Api\Admin\User;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class DeleteUserController extends Controller
{

    /**
    * @var \Src\Admin\User\Infraestructure\DeleteUserController
     */
    private $deleteUserController;

    public function __construct(\Src\Admin\User\Infraestructure\DeleteUserController $deleteUserController )
    {
        $this->deleteUserController = $deleteUserController;
    }

    public function __invoke( Request $request )
    {
        try {
            $this->deleteUserController->__invoke( $request );
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
