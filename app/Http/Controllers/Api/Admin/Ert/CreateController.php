<?php


namespace App\Http\Controllers\Api\Admin\Ert;


use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Ert\ErtResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CreateController extends Controller
{

    /**
    * @var \Src\Admin\Ert\Infrastructure\CreateController
     */
    private $controller;

    public function __construct(\Src\Admin\Ert\Infrastructure\CreateController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request )
    {
        try {

            $OErt = new ErtResource( $this->controller->__invoke( $request ) );
            return response()->json([
                'data' => $OErt,
                'error' => null,
                'status' => Response::HTTP_CREATED
            ]);

        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Ert not found',
                'status' => Response::HTTP_NOT_FOUND
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
