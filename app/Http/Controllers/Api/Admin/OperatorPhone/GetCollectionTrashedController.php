<?php


namespace App\Http\Controllers\Api\Admin\OperatorPhone;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OperatorPhone\OperatorPhoneResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionTrashedController extends Controller
{

    /**
    * @var \Src\Admin\OperatorPhone\Infrastructure\GetCollectionTrashedController
     */
    private $getCollectionTrashedController;

    public function __construct(\Src\Admin\OperatorPhone\Infrastructure\GetCollectionTrashedController $getCollectionTrashedController )
    {
        $this->getCollectionTrashedController = $getCollectionTrashedController;
    }

    public function __invoke( Request $request )
    {
        try {
            $operators = OperatorPhoneResource::collection( $this->getCollectionTrashedController->__invoke( $request ) );
            return response()->json([
                'data' => $operators,
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
