<?php


namespace App\Http\Controllers\Api\Admin\Module;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Module\ModuleResource;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class TrashController extends Controller
{

    /**
    * @var \Src\Admin\Module\Infrastructure\TrashController
     */
    private $controller;

    public function __construct(\Src\Admin\Module\Infrastructure\TrashController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {
            ModuleResource::make( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Module not found',
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
