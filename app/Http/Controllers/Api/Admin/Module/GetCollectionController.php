<?php


namespace App\Http\Controllers\Api\Admin\Module;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Module\ModuleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetCollectionController extends Controller
{

    /**
    * @var \Src\Admin\Module\Infrastructure\GetCollectionController
     */
    private $controller;

    public function __construct(\Src\Admin\Module\Infrastructure\GetCollectionController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            $models = ModuleResource::collection( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => $models,
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
