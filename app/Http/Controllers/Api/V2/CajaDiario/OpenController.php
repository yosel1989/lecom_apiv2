<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Enums\EnumPuntoVenta;
use App\Enums\IdEliminado;
use App\Enums\IdEstado;
use App\Enums\IdTipoComprobante;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OpenController extends Controller
{
    private \Src\V2\CajaDiario\Infrastructure\OpenController $controller;

    public function __construct(\Src\V2\CajaDiario\Infrastructure\OpenController $controller)
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

            $Vehiculo = \App\Models\Administracion\Vehiculo::where('id',$request->input('idVehiculo'))
                ->where('idEstado', IdEstado::Habilitado)
                ->where('idEliminado',IdEliminado::NoEliminado)
                ->get();
            if( $Vehiculo->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'El vehiculo con la placa '. $request->input('placa') . ' no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }
            $_vehiculo = $Vehiculo->first();

            $TiposComprobante = \App\Models\V2\TipoComprobante::where('blPuntoVenta', EnumPuntoVenta::Si)
                ->get();
            if( $TiposComprobante->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Los tipos de comprobante no se encuentras registrados en el sistema.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }



//            return response()->json($id);
            $this->controller->__invoke($request);
            return response()->json([
                'data' => [
                    'tiposComprobante' => $TiposComprobante->map(function($tc, $key) use ($_vehiculo) {

                        $serieLetra = '';
                        switch ( $tc->id ){
                            case IdTipoComprobante::Boleta->value: $serieLetra = 'B'; break;
                            case IdTipoComprobante::Factura->value: $serieLetra = 'F'; break;
                            default: $serieLetra = 'B'; break;
                        }

                        return [
                            'id' => $tc->id,
                            'nombre' => $tc->nombre,
                            'serie' => $serieLetra . str_pad($_vehiculo->codigo,3,'0',STR_PAD_LEFT),
                        ];
                    }),
                ],
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
