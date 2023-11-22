<?php


namespace App\Http\Controllers\Api\V2\CajaDiario;


use App\Enums\EnumParametroConfiguracion;
use App\Enums\EnumPuntoVenta;
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

            $_vehiculo = null;

            if($request->has('idVehiculo')){
                $Vehiculo = \App\Models\Administracion\Vehiculo::where('id',$request->input('idVehiculo'))
                    ->where('id_estado', IdEstado::Habilitado)
                    ->where('id_eliminado',IdEliminado::NoEliminado)
                    ->get();
                if( $Vehiculo->isEmpty() ){
                    return response()->json([
                        'data'      => null,
                        'error' => 'El vehiculo con la placa '. $request->input('placa') . ' no se encuentra registrado en el sistema o se encuentra inhabilitado.',
                        'status' => Response::HTTP_NOT_FOUND
                    ]);
                }
                $_vehiculo = $Vehiculo->first();
            }


            $TiposComprobante = \App\Models\V2\TipoComprobante::where('bl_punto_venta', 1)
                ->get();
            if( $TiposComprobante->isEmpty() ){
                return response()->json([
                    'data'      => null,
                    'error' => 'Los tipos de comprobante no se encuentras registrados en el sistema.',
                    'status' => Response::HTTP_NOT_FOUND
                ]);
            }

            $Configuracion = ClienteConfiguracion::where('id_cliente', $request->input('idCliente'))
                ->where('id_parametro_configuracion', EnumParametroConfiguracion::NumeroComprobantesDiarios->value)->get();

            $this->controller->__invoke($request);

            return response()->json([
                'data' => [
                    'tiposComprobante' => $request->has('idVehiculo') ? $TiposComprobante->map(function($tc, $key) use ($_vehiculo, $request) {

                        $serieLetra = '';
                        switch ( $tc->id ){
                            case IdTipoComprobante::Boleta->value: $serieLetra = 'B'; break;
                            case IdTipoComprobante::Factura->value: $serieLetra = 'F'; break;
                            case IdTipoComprobante::Ticket->value: $serieLetra = 'T'; break;
                            default: $serieLetra = 'T'; break;
                        }

                        $serie = $serieLetra . str_pad($_vehiculo->codigo,3,'0',STR_PAD_LEFT);
                        $OCliente = Cliente::findOrFail($request->input('idCliente'));
                        $BoletoInterprovincial = new BoletoInterprovincial();
                        $BoletoInterprovincial->setTable('boleto_interprovincial_cliente_' . $OCliente->codigo);

                        $ComprobanteElectronico = new ComprobanteElectronico();

                        return [
                            'id' => $tc->id,
                            'nombre' => $tc->nombre,
                            'serie' => $serie,
                            'ultimoNumero' => is_null($ComprobanteElectronico
                                ->where('serie',$serie)
                                ->where('id_cliente',$request->input('idCliente'))
                                ->where('id_tipo_comprobante', $tc->id)
                                ->max('numero')) ?
                                0 :
                                $ComprobanteElectronico
                                    ->where('serie',$serie)
                                    ->where('id_cliente',$request->input('idCliente'))
                                    ->where('id_tipo_comprobante', $tc->id)
                                    ->max('numero')
                        ];
                    }) : [],
                    'configuracion' => [
                        'numeroComprobantesDiarios' => !$Configuracion->isEmpty() ? (int)$Configuracion->first()->valor : 0
                    ]
                ],
                'error' =>  null,
                'status' => Response::HTTP_CREATED
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
