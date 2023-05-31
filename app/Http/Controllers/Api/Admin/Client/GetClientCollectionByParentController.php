<?php


namespace App\Http\Controllers\Api\Admin\Client;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ClientResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetClientCollectionByParentController extends Controller
{

    /**
    * @var \Src\Admin\Client\Infraestructure\GetClientCollectionByParentController
     */
    private $createClientController;

    public function __construct(\Src\Admin\Client\Infraestructure\GetClientCollectionByParentController $createClientController )
    {
        $this->createClientController = $createClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $OClient = ClientResource::collection( $this->createClientController->__invoke( $request ) );
            return response()->json([
                'data' => $OClient,
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
