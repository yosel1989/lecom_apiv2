<?php


namespace App\Http\Controllers\Api\V2\CronogramaSalida;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as StatusCode;

class CreateController extends Controller
{
    private \Src\V2\CronogramaSalida\Infrastructure\CreateController $controller;

    public function __construct(
        \Src\V2\CronogramaSalida\Infrastructure\CreateController $controller
    )
    {
        $this->controller = $controller;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $this->controller->__invoke($request);
            return response()->json([
                'data' => null,
                'error' =>  null,
                'status' => StatusCode::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => StatusCode::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
