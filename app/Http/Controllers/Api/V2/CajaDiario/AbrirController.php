<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Enums\EnumParametroConfiguracion;
use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoComprobante;
use App\Http\Controllers\Controller;
use App\Models\V2\BoletoInterprovincial;
use App\Models\V2\Cliente;
use App\Models\V2\ClienteConfiguracion;
use App\Models\V2\ComprobanteElectronico;
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

            $this->controller->__invoke($request);
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
