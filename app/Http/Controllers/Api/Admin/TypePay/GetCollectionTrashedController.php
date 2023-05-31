<?php


namespace App\Http\Controllers\Api\Admin\TypePay;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TypePay\TypePayResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\TypePay\Infrastructure\GetCollectionTrashedController
     */
    private $getTypePayCollectionController;

    public function __construct(\Src\Admin\TypePay\Infrastructure\GetCollectionTrashedController $getTypePayCollectionController )
    {
        $this->getTypePayCollectionController = $getTypePayCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $typesInvoicing = TypePayResource::collection( $this->getTypePayCollectionController->__invoke( $request ) );
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
