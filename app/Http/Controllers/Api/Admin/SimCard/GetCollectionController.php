<?php


namespace App\Http\Controllers\Api\Admin\SimCard;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SimCard\SimCardResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Admin\SimCard\Infrastructure\GetCollectionController
     */
    private $getCollectionController;

    public function __construct(\Src\Admin\SimCard\Infrastructure\GetCollectionController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $simCards = SimCardResource::collection( $this->getCollectionController->__invoke( $request ) );
            return response()->json([
                'data' => $simCards,
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
