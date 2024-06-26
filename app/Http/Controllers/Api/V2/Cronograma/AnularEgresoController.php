<?php


namespace App\Http\Controllers\Api\V2\Cronograma;


use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AnularCronogramaController extends Controller
{

    /**
    * @var \Src\V2\Cronograma\Infrastructure\AnularCronogramaController
     */
    private $controller;

    public function __construct(\Src\V2\Cronograma\Infrastructure\AnularCronogramaController $controller )
    {
        $this->controller = $controller;
    }

    public function __invoke( Request $request ): \Illuminate\Http\JsonResponse
    {
        try {
            $this->controller->__invoke( $request );
            return response()->json([
                'data' => null,
                'error' => null,
                'status' => ResponseAlias::HTTP_OK
            ]);
        }catch ( ModelNotFoundException $e ) {

            return response()->json([
                'data' => null,
                'error' => 'El Cronograma no se encontro en los registros',
                'status' => ResponseAlias::HTTP_NOT_FOUND
            ]);

        }catch ( InvalidArgumentException $e ){
            return response()->json([
                'data' => null,
                'error' => $e->getMessage(),
                'status' => ResponseAlias::HTTP_BAD_REQUEST
            ]);
        }

    }
}
