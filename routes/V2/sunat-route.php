<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;


Route::middleware('auth:sanctum')->group(function() {
    Route::get('app/sunat-consulta/{idTipoDocumento}/{numeroDocumento}', function(Request $request, int $idTipoDocumento, string $numeroDocumento){


        // Datos
        $token = 'apis-token-5227.qK6OMuUPY45HWN9j-VY5dWjdMWZPqZG5';
        $numeroDocumento = $numeroDocumento;

        if(\App\Enums\IdTipoDocumento::Ruc->value === $idTipoDocumento){

            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar ruc sunat
            curl_setopt_array($curl, array(
                // para usar la versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $numeroDocumento,
                // para usar la versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: http://apis.net.pe/api-ruc',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos de empresas según padron reducido
            $empresa = json_decode($response);

            if(isset($empresa->message)){
                return response()->json([
                    'data'      => null,
                    'error' => $empresa->message,
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            return response()->json([
                'data'      => [
                    'idTipoDocumento' => \App\Enums\IdTipoDocumento::Ruc->value,
                    'nombre' => $empresa->razonSocial,
                    'direccion' => $empresa->direccion . ' , ' . $empresa->departamento . ' - ' . $empresa->provincia . ' - ' . $empresa->distrito
                ],
//                'data2'      => $empresa,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);

        }else if( \App\Enums\IdTipoDocumento::Dni->value === $idTipoDocumento ){
            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
                // para user api versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $numeroDocumento,
                // para user api versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos listos para usar
            $persona = json_decode($response);

            if(isset($persona->message)){
                return response()->json([
                    'data'      => null,
                    'error' => $persona->message,
                    'status' => Response::HTTP_BAD_REQUEST
                ]);
            }

            return response()->json([
                'data'      => [
                    'idTipoDocumento' => \App\Enums\IdTipoDocumento::Dni->value,
                    'nombre' => $persona->nombres . ' ' . $persona->apellidoPaterno . ' ' . $persona->apellidoMaterno,
                    'nombres' => $persona->nombres,
                    'apellidos' => $persona->apellidoPaterno . ' ' . $persona->apellidoMaterno,
                    'direccion' => null
                ],
                'data2'      => $persona,
                'error' => null,
                'status' => Response::HTTP_OK
            ]);

        }else{
            return response()->json([
                'data'      => null,
                'error' => 'Error en el tipo de documento',
                'status' => Response::HTTP_BAD_REQUEST
            ]);
        }

    });




    Route::post('app/consulta-masiva-dni', function(Request $request){

        ini_set('max_execution_time', 360);

        $listado_dni = $request->input('data');


        // Datos
        $token = 'apis-token-5227.qK6OMuUPY45HWN9j-VY5dWjdMWZPqZG5';

        $collection = [];

        foreach ($listado_dni as $dni){

            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
                // para user api versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
                // para user api versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos listos para usar
            $persona = json_decode($response);

            if(isset($persona->message)){

                $collection[] = implode(',', [
                    $dni,
                    'Cliente No',
                    'Cliente No',
                    'Cliente No'
                ]);

            }else{
                $collection[] = implode(',', [
                    $dni,
                    $persona->nombres . ' ' . $persona->apellidoPaterno . ' ' . $persona->apellidoMaterno,
                    $persona->nombres,
                    $persona->apellidoPaterno . ' ' . $persona->apellidoMaterno
                ]);
            }
        }

        return response()->json([
            'data'      => $collection
        ]);

    });
});
