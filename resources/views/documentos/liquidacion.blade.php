<!doctype html>
    <table class="table table-sm">
        <thead>
            <tr>
                <td colspan="10" style="font-size: 20px"><b>LIQUIDACIÓN DEL {{ $liquidacion->getFechaDesde()->value() }} AL {{ $liquidacion->getFechaHasta()->value() }}</b></td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="8" style="font-size: 14px; background: #B3EEA7"><b>INGRESOS </b></td>
            </tr>
            <tr>
                <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae"><b>PLACA/FECHA</b></td>
                @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae">{{ $fecha->format('d-') . mb_strtolower($utilidades->mesCorto($fecha->format('m'))) }}</td>
                @endforeach
                <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae"><b>TOTAL</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
            <tr>
                <td style="border: 10px solid #4056ae">{{ $vehiculo->getPlaca()->value() }}</td>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                    @php
                        $encontrado = array_filter($liquidacion->getIngresoTotalBoleto()->all(), function ($obj) use ($fechas, $vehiculo) {
                          return $obj->getFecha()->value() == $fechas->format('Y-m-d') && $obj->getIdVehiculo()->value() === $vehiculo->getId()->value();
                        });
                         $encontrado = (count($encontrado) > 0) ? reset($encontrado) : null;
                    @endphp
                    <td style="border: 10px solid #4056ae">{{ !is_null($encontrado) ? $encontrado->getTotal()->value() : 0 }}</td>
                @endforeach
                @php
                    $totalIngresoVehiculo = 0;
                    foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                        $totalIngresoVehiculo += $item->getIdVehiculo()->value() === $vehiculo->getId()->value() ? $item->getTotal()->value() : 0;
                    }
                @endphp
                <td style="border: 10px solid #4056ae"><b>{{ $totalIngresoVehiculo }}</b></td>
            </tr>
            @endforeach
            <tr>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                <td></td>
                @endforeach
                <td style="border: 10px solid #4056ae"><b>INGRESOS</b></td>
                @php
                    $totalIngreso = 0;
                    foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                        $totalIngreso +=  $item->getTotal()->value();
                    }
                @endphp
                    <td style="border: 10px solid #4056ae"><b>{{ $totalIngreso }}</b></td>
            </tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>




    <table class="table table-sm">
        <thead>
        <tr>
            <td colspan="8" style="font-size: 14px; background: #FF8000"><b>EGRESOS </b></td>
        </tr>
        <tr>
            <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #4056ae"><b>PLACA/FECHA</b></td>
            @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae">{{ $fecha->format('d-') . mb_strtolower($utilidades->mesCorto($fecha->format('m'))) }}</td>
            @endforeach
            <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae"><b>TOTAL</b></td>
        </tr>
        </thead>
        <tbody>
            @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
                <tr>
                    <td style="border: 10px solid #4056ae">{{ $vehiculo->getPlaca()->value() }}</td>
                    @foreach($liquidacion->getFechaPeriodo() as $fechas)
                        @php
                            $encontrado = array_filter($liquidacion->getEgresoTotalPorVehiculo(), function ($obj) use ($fechas, $vehiculo) {
                              return $obj->getFecha()->value() == $fechas->format('Y-m-d') && $obj->getIdVehiculo()->value() === $vehiculo->getId()->value();
                            });
                             $encontrado = (count($encontrado) > 0) ? reset($encontrado) : null;
                        @endphp
                        <td style="border: 10px solid #4056ae">{{ !is_null($encontrado) ? $encontrado->getTotal()->value() : 0 }}</td>
                    @endforeach
                    @php
                        $totalIngresoVehiculo = 0;
                        foreach ($liquidacion->getEgresoTotalPorVehiculo() as $item) {
                            $totalIngresoVehiculo += $item->getIdVehiculo()->value() === $vehiculo->getId()->value() ? $item->getTotal()->value() : 0;
                        }
                    @endphp
                    <td style="border: 10px solid #4056ae"><b>{{ $totalIngresoVehiculo }}</b></td>
                </tr>
            @endforeach
            <tr>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                    <td></td>
                @endforeach
                <td style="border: 10px solid #4056ae"><b>EGRESOS</b></td>
                @php
                    $totalIngreso = 0;
                    foreach ($liquidacion->getEgresoTotalPorVehiculo() as $item) {
                        $totalIngreso +=  $item->getTotal()->value();
                    }
                @endphp
                <td style="border: 10px solid #4056ae"><b>{{ $totalIngreso }}</b></td>
            </tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>

    <table class="table table-sm">
        <thead>
            <tr>
                <td colspan="8"><b>VEHICULOS </b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
            <tr>
                <td>{{ $vehiculo->getPlaca()->value() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
