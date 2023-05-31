<?php


namespace App\Http\Controllers\Api\Admin\Client;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TrashClientController extends Controller
{

    /**
    * @var \Src\Admin\Client\Infraestructure\TrashClientController
     */
    private $trashClientController;

    public function __construct(\Src\Admin\Client\Infraestructure\TrashClientController $trashClientController )
    {
        $this->trashClientController = $trashClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $this->trashClientController->__invoke( $request );
            return response()->json([
                'data' => null,
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
