<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Http\Controllers\Controller;
use App\Http\Resources\V2\CajaDiario\CajaDiarioReporteSaldoResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class ReporteSaldoController extends Controller
{
    private \Src\V2\CajaDiario\Infrastructure\ReporteSaldoController $controller;

    public function __construct(\Src\V2\CajaDiario\Infrastructure\ReporteSaldoController $controller)
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

            $collection = CajaDiarioReporteSaldoResource::collection($this->controller->__invoke($request));

            return response()->json([
                'data' => $collection,
                'error' =>  null,
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage() . $e->getTraceAsString(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => null,
                'error' => $e->getMessage() . $e->getTraceAsString(),
                'status' => $e->getCode()
            ]);

        }
    }
}
