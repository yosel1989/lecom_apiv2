<?php


namespace App\Http\Controllers\Api\Admin\Module;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Module\ModuleResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\Module\Infrastructure\CreateController
     */
    private $controller;

    public function __construct(\Src\Admin\Module\Infrastructure\CreateController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            $module = ModuleResource::make( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => $module,
                'error' => null,
                'status' => Response::HTTP_CREATED
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
