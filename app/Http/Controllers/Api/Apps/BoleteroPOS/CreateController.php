<?php


namespace App\Http\Controllers\Api\Apps\BoleteroPOS;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CreateController extends Controller
{
    private \Src\V2\Destino\Infrastructure\CreateController $controller;

    public function __construct(\Src\V2\Destino\Infrastructure\CreateController $controller)
    {
        $this->controller = $controller;
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        try {

            $this->controller->__invoke($request, $id);
            return response()->json([
                'data' => null,
                'error' =>  null,
                'status' => ResponseAlias::HTTP_CREATED
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => ResponseAlias::HTTP_BAD_REQUEST
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
