<?php

namespace App\Http\Controllers\Api\Cold\ColdMachineAlertHistory;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CountByClientController extends Controller
{

    /**
    * @var \Src\Cold\ColdMachineAlertHistory\Infrastructure\CountByClientController
     */
    private $getCollectionController;

    public function __construct(\Src\Cold\ColdMachineAlertHistory\Infrastructure\CountByClientController $getCollectionController )
    {
        $this->getCollectionController = $getCollectionController;
    }

    public function __invoke( Request $request )
    {
        try {
            $count = $this->getCollectionController->__invoke( $request );
            return response()->json([
                'data' => [ 'count' => $count ],
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
