<?php

namespace App\Http\Controllers\Api\V2\ModuloMenu;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\ModuloMenu\ModuloMenuListToPerfilResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetListToUsuarioPerfilController extends Controller
{
    private \Src\V2\ModuloMenu\Infrastructure\GetListToUsuarioPerfilController $controller;

    public function __construct(\Src\V2\ModuloMenu\Infrastructure\GetListToUsuarioPerfilController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(Request $request, string $idPerfil)
    {
        try {

            //return response()->json(ModuloMenu::all());

            $collection = ModuloMenuListToPerfilResource::collection($this->controller->__invoke($request, $idPerfil));
            return response()->json([
                'data' => $collection,
                'error' =>  null,
                'trace' => null,
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'status' => $e->getCode()
            ]);

        }
    }
}
