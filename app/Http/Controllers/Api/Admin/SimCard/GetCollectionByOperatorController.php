<?php


namespace App\Http\Controllers\Api\Admin\SimCard;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SimCard\SimCardResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByOperatorController extends Controller
{

    /**
    * @var \Src\Admin\SimCard\Infrastructure\GetCollectionByOperatorController
     */
    private $controller;

    public function __construct(\Src\Admin\SimCard\Infrastructure\GetCollectionByOperatorController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            $simCards = SimCardResource::collection( $this->controller->__invoke( $request ) );
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
