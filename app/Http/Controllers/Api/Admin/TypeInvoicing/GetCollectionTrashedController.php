<?php


namespace App\Http\Controllers\Api\Admin\TypeInvoicing;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TypeInvoicing\TypeInvoicingResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\TypeInvoicing\Infrastructure\GetCollectionTrashedController
     */
    private $getTypeInvoicingCollectionController;

    public function __construct(\Src\Admin\TypeInvoicing\Infrastructure\GetCollectionTrashedController $getTypeInvoicingCollectionController )
    {
        $this->getTypeInvoicingCollectionController = $getTypeInvoicingCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $typesInvoicing = TypeInvoicingResource::collection( $this->getTypeInvoicingCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $typesInvoicing,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( InvalidArgumentException | Exception $e ){
            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }
    }
}
