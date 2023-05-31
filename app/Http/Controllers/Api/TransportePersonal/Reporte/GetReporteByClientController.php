<?php


namespace App\Http\Controllers\Api\TransportePersonal\Reporte;


use App\Http\Controllers\Controller;
use App\Http\Resources\TransportePersonal\Reporte\CollectionResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class GetReporteByClientController extends Controller
{
    /**
     * @var \Src\TransportePersonal\Reporte\Infraestructure\GetReportByClientController
     */
    private $controller;

    public function __construct(\Src\TransportePersonal\Reporte\Infraestructure\GetReportByClientController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {

//            return response()->json(AbordajeDestino::with('paraderoAbordaje:id,name','paraderoDestino:id,name','tipoRuta:id,name')
//                ->where('id_client', $request->id)
//                ->get());
            $collection = CollectionResource::collection($this->controller->__invoke($request));
            return response()->json([
                'data' => $collection,
                'message' =>  "",
                'status' => Response::HTTP_OK
            ]);

        }catch ( InvalidArgumentException $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => Response::HTTP_BAD_REQUEST
            ]);

        }catch ( Exception $e ){

            return response()->json([
                'data' => [],
                'message' => $e->getMessage(),
                'status' => $e->getCode()
            ]);

        }
    }
}
