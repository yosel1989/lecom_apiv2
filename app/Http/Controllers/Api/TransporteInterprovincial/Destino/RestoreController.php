<?php


namespace App\Http\Controllers\Api\TransporteInterprovincial\Destino;


use App\Http\Controllers\Controller;
use App\Http\Resources\TransporteInterprovincial\Destino\DestinoResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RestoreController extends Controller
{

    /**
    * @var \Src\TransporteInterprovincial\Destino\Infrastructure\RestoreController
     */
    private $restoreController;

    public function __construct(\Src\TransporteInterprovincial\Destino\Infrastructure\RestoreController $restoreController )
    {
        $this->restoreController = $restoreController;
    }

    public function __invoke( Request $request )
    {
        try {
            DestinoResource::make( $this->restoreController->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Destino not found',
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
