<?php


namespace App\Http\Controllers\Api\Admin\Client;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ClientResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateClientController extends Controller
{

    /**
    * @var \Src\Admin\Client\Infraestructure\CreateClientController
     */
    private $createClientController;

    public function __construct(\Src\Admin\Client\Infraestructure\CreateClientController $createClientController )
    {
        $this->createClientController = $createClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $OClient = new ClientResource( $this->createClientController->__invoke( $request ) );
            return response()->json([
                'data' => $OClient,
                'error' => null,
                'status' => Response::HTTP_CREATED
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
