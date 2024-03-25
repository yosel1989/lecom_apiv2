<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Http\Controllers\Controller;
use App\Http\Resources\V2\Caja\CajaSedeResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MontoActualController extends Controller
{
    private \Src\V2\CajaDiario\Infrastructure\MontoActualController $controller;

    public function __construct(\Src\V2\CajaDiario\Infrastructure\MontoActualController $controller)
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

            $cajaSede = CajaSedeResource::make( $this->controller->__invoke($request) );
            return response()->json([
                'data' => $cajaSede,
                'error' =>  null,
                'status' => ResponseAlias::HTTP_OK
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
