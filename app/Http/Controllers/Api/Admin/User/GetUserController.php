<?php


namespace App\Http\Controllers\Api\Admin\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetUserController extends Controller
{

    /**
    * @var \Src\Admin\User\Infraestructure\GetUserController
     */
    private $getUserController;

    public function __construct(\Src\Admin\User\Infraestructure\GetUserController $getUserController )
    {
        $this->getUserController = $getUserController;
    }

    public function __invoke( Request $request )
    {
        try {
            $OUser = new UserResource( $this->getUserController->__invoke( $request ) );
            return response()->json([
                'data' => $OUser,
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
