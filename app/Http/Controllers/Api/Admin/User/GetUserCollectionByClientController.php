<?php


namespace App\Http\Controllers\Api\Admin\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetUserCollectionByClientController extends Controller
{

    /**
    * @var \Src\Admin\User\Infraestructure\GetUserCollectionByClientController
     */
    private $getUserCollectionByClientController;

    public function __construct(\Src\Admin\User\Infraestructure\GetUserCollectionByClientController $getUserCollectionByClientController )
    {
        $this->getUserCollectionByClientController = $getUserCollectionByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $OUser = UserResource::collection( $this->getUserCollectionByClientController->__invoke( $request ) );
            return response()->json([
                'data' => $OUser,
                'error' => null,
                'status' => Response::HTTP_OK
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
