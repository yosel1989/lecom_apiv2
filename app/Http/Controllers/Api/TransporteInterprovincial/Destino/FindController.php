<?php


namespace App\Http\Controllers\Api\TransporteInterprovincial\Destino;


use App\Http\Controllers\Controller;
use App\Http\Resources\TransporteInterprovincial\Destino\DestinoResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class FindController extends Controller
{

    /**
    * @var \Src\TransporteInterprovincial\Destino\Infrastructure\FindController
     */
    private $FindController;

    public function __construct(\Src\TransporteInterprovincial\Destino\Infrastructure\FindController $FindController )
    {
        $this->FindController = $FindController;
    }

    public function __invoke( Request $request )
    {
        try {
            $output = DestinoResource::make( $this->FindController->__invoke( $request ) );
            return response()->json([
                'data' => $output,
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
