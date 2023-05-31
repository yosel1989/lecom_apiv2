<?php


namespace App\Http\Controllers\Older;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class RegisterErtStateController extends Controller
{
    /**
     * @var \Src\Older\Ert\Infraestructure\RegisterStateController
     */
    private $registerStateController;

    public function __construct(\Src\Older\Ert\Infraestructure\RegisterStateController $registerStateController )
    {
        $this->registerStateController = $registerStateController;
    }

    public function __invoke( Request $request )
    {
        try {
            $this->registerStateController->__invoke( $request );
            return response()->json([
                'dat' => null,
                'error' =>  null,
                'status' => Response::HTTP_CREATED
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'Model not found ',
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
