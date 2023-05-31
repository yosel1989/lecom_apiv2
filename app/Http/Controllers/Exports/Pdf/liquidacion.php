<?php

namespace App\Http\Controllers\Exports\Pdf;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Src\Admin\Client\Application\GetClientUseCase;
use Src\Admin\Client\Infraestructure\Repositories\EloquentClientRepository;
use Src\Admin\Vehicle\Infrastructure\Repositories\EloquentVehicleRepository;
use Src\Administracion\Personal\Infraestructure\Repositories\EloquentPersonalRepository;
use Src\VehicleTicketing\Ticket\Application\GetLiquidacionDiariaBusUseCase;
use Src\VehicleTicketing\Ticket\Infraestructure\Repositories\EloquentTicketRepository;

class liquidacion extends Controller
{

    private $egresoController;
    /**
     * @var EloquentPersonalRepository
     */
    private $personalRepository;
    private $vehiculoRepository;
    private $clienteRepository;
    private $ticketRepository;

    public function __construct(
        \Src\Administracion\Egreso\Infraestructure\GetLiquidacionDiariaBusController $egresoController,
        EloquentPersonalRepository $personalRepository,
        EloquentVehicleRepository $vehiculoRepository,
        EloquentClientRepository $clienteRepository,
        EloquentTicketRepository $ticketRepository
    )
    {
        $this->egresoController = $egresoController;
        $this->personalRepository = $personalRepository;
        $this->vehiculoRepository = $vehiculoRepository;
        $this->clienteRepository = $clienteRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $IdCliente       = $request->idCliente;
            $Fecha       = $request->fecha;
            $IdVehiculo       = $request->idVehiculo;

            $collection = $this->egresoController->__invoke($request);

            $vehiculoUseCase = new GetLiquidacionDiariaBusUseCase($this->ticketRepository);
            $boletos = $vehiculoUseCase->__invoke($IdCliente, $Fecha, $IdVehiculo);

//          $personalUseCase = new FindUseCase($this->personalRepository);
//          $personal = $personalUseCase->__invoke($request->idPersonal);

            $vehiculoUseCase = new \Src\Admin\Vehicle\Application\FindUseCase($this->vehiculoRepository);
            $vehiculo = $vehiculoUseCase->__invoke($request->idVehiculo);

            $clienteUseCase = new GetClientUseCase($this->clienteRepository);
            $cliente = $clienteUseCase->__invoke($request->idCliente);

            $fecha = new \DateTime($request->fecha);

            $pdf = Pdf::loadView('Pdf.liquidacion', [
                'egresos' => $collection,
                'totalEgresos' => $this->getTotalEgresos($collection),
                'totalBoletos' => $this->getTotalBoletos($boletos),
                'totalNumeroBoletos' => $this->getTotalNumeroBoletos($boletos),
                'fecha' => $fecha,
                'boletos' => $boletos,
//                'personal' => $personal,
                'vehiculo' => $vehiculo,
                'cliente' => $cliente,
                'previsualizacion' => true
            ]);
            $pdf->setPaper('L');
            $pdf->output();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->set_opacity(.2,"Multiply");
            $canvas->set_opacity(.2);
            $canvas->page_text($width/5, $height/2, 'PREVISUALIZACIÓN', null,50, array(0,0,0),2,2,-38);

            return $pdf->download('sample.pdf');
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Functions
    public function getTotalEgresos(array $egresos): float
    {
        $total = 0.0;
        if(!count($egresos)){return $total;}
        foreach ($egresos as $item) {
            $total += (float)$item->getTotal()->value();
        }
        return $total;
    }

    public function getTotalBoletos(array $boletos): float
    {
        $total = 0.0;
        if(!count($boletos)){return $total;}
        foreach ($boletos as $item) {
            $total += (float)$item->getTotal()->value();
        }
        return $total;
    }

    public function getTotalNumeroBoletos(array $boletos): float
    {
        $total = 0;
        if(!count($boletos)){return $total;}
        foreach ($boletos as $item) {
            $total += $item->getNumeroBoletos()->value();
        }
        return $total;
    }

}
