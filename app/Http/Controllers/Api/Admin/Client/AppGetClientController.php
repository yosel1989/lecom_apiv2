<?php


namespace App\Http\Controllers\Api\Admin\Client;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ClientResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class AppGetClientController extends Controller
{

    /**
    * @var \Src\Admin\Client\Infraestructure\GetClientController
     */
    private $getClientController;

    public function __construct(\Src\Admin\Client\Infraestructure\GetClientController $getClientController )
    {
        $this->getClientController = $getClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $OClient = new ClientResource( $this->getClientController->__invoke( $request ) );
            return response()->json([
                'data' => $OClient,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Client not found',
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
