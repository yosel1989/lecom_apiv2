<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AbrirController extends Controller
{
    private \Src\V2\CajaDiario\Infrastructure\AbrirController $controller;

    public function __construct(\Src\V2\CajaDiario\Infrastructure\AbrirController $controller)
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

            $id = $this->controller->__invoke($request);
            return response()->json([
                'data' => $id,
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
