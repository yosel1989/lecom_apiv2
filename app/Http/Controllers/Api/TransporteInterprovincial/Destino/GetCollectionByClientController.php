<?php


namespace App\Http\Controllers\Api\TransporteInterprovincial\Destino;


use App\Http\Controllers\Controller;
use App\Http\Resources\TransporteInterprovincial\Destino\DestinoResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{

    /**
    * @var \Src\TransporteInterprovincial\Destino\Infrastructure\GetCollectionByClientController
     */
    private $GetCollectionByClientController;

    public function __construct(\Src\TransporteInterprovincial\Destino\Infrastructure\GetCollectionByClientController $GetCollectionByClientController )
    {
        $this->GetCollectionByClientController = $GetCollectionByClientController;
    }

    public function __invoke( Request $request )
    {
        try {
            $Destinos = DestinoResource::collection( $this->GetCollectionByClientController->__invoke( $request ) );
            return response()->json([
                'data' => $Destinos,
                'error' => null,
                'status' => Response::HTTP_OK
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
