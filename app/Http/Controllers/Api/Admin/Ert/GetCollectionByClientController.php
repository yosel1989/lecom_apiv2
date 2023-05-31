<?php


namespace App\Http\Controllers\Api\Admin\Ert;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Ert\ErtResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionByClientController extends Controller
{

    /**
    * @var \Src\Admin\Ert\Infrastructure\GetCollectionByClientController
     */
    private $controller;

    public function __construct(\Src\Admin\Ert\Infrastructure\GetCollectionByClientController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            $OErt = ErtResource::collection( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => $OErt,
                'error' => null,
                'status' => Response::HTTP_OK
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
