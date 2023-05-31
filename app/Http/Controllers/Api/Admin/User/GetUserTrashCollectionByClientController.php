<?php


namespace App\Http\Controllers\Api\Admin\User;


use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetUserTrashCollectionByClientController extends Controller
{

    /**
    * @var \Src\Admin\User\Infraestructure\GetUserTrashCollectionByClientController
     */
    private $getUserTrashCollectionByClientController;

    public function __construct(\Src\Admin\User\Infraestructure\GetUserTrashCollectionByClientController $getUserTrashCollectionByClientController )
    {
        $this->getUserTrashCollectionByClientController = $getUserTrashCollectionByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Users = UserResource::collection( $this->getUserTrashCollectionByClientController->__invoke( $request ) );
            return response()->json([
                'data' => $Users,
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
