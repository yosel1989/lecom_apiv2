<!doctype html>
    <tr>
        <td colspan="10" style="font-size: 20px"><b>N° {{ str_pad(($liquidacion->getCodigo()->value()+1), 10, "0", STR_PAD_LEFT) }} </b></td>
    </tr>
    <tr>
        <td colspan="10" style="font-size: 20px"><b>LIQUIDACIÓN DEL {{ $liquidacion->getFechaDesde()->value() }} AL {{ $liquidacion->getFechaHasta()->value() }}</b></td>
    </tr>
    <tr></tr>

    <table class="table table-sm">
        <thead>
        <tr>
            <td colspan="8" style="font-size: 14px; background: #9d9d9d; border: 1px solid #242f59"><b>VEHICULOS </b></td>
        </tr>
        </thead>
        <tbody>
        @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
            <tr>
                <td colspan="8" style="font-size: 12px; border: 1px solid #242f59">{{ $vehiculo->getPlaca()->value() }}</td>
            </tr>
        @endforeach
            <tr></tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>


    <table class="table table-sm">
        <thead>
            <tr>
                <td colspan="8" style="font-size: 14px; background: #B3EEA7; border: 1px solid #242f59"><b>INGRESOS </b></td>
            </tr>
            <tr>
                <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #242f59"><b>PLACA/FECHA</b></td>
                @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td style="background-color: #F0F2F9; color: #4056ae; border:2cm solid #4056ae">{{ $fecha->format('d-') . mb_strtolower($utilidades->mesCorto($fecha->format('m'))) }}</td>
                @endforeach
                <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #242f59"><b>TOTAL</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
            <tr>
                <td style="border: 1px solid #242f59">{{ $vehiculo->getPlaca()->value() }}</td>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                    @php
                        $encontrado = array_filter($liquidacion->getIngresoTotalBoleto()->all(), function ($obj) use ($fechas, $vehiculo) {
                          return $obj->getFecha()->value() == $fechas->format('Y-m-d') && $obj->getIdVehiculo()->value() === $vehiculo->getId()->value();
                        });
                         $encontrado = (count($encontrado) > 0) ? reset($encontrado) : null;
                    @endphp
                    <td style="border: 1px solid #242f59">{{ !is_null($encontrado) ? $encontrado->getTotal()->value() : 0 }}</td>
                @endforeach
                @php
                    $totalIngresoVehiculo = 0;
                    foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                        $totalIngresoVehiculo += $item->getIdVehiculo()->value() === $vehiculo->getId()->value() ? $item->getTotal()->value() : 0;
                    }
                @endphp
                <td style="border: 1px solid #242f59"><b>{{ $totalIngresoVehiculo }}</b></td>
            </tr>
            @endforeach
            <tr>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                <td></td>
                @endforeach
                <td style="border: 1px solid #242f59"><b>INGRESOS</b></td>
                @php
                    $totalIngreso = 0;
                    foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                        $totalIngreso +=  $item->getTotal()->value();
                    }
                @endphp
                    <td style="border: 1px solid #242f59"><b>{{ $totalIngreso }}</b></td>
            </tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>




    <table class="table table-sm">
        <thead>
        <tr>
            <td colspan="8" style="font-size: 14px; background: #FF8000; border: 1px solid #242f59"><b>EGRESOS </b></td>
        </tr>
        <tr>
            <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #242f59"><b>PLACA/FECHA</b></td>
            @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #242f59">{{ $fecha->format('d-') . mb_strtolower($utilidades->mesCorto($fecha->format('m'))) }}</td>
            @endforeach
            <td style="background-color: #F0F2F9; color: #4056ae; border: 1px solid #242f59"><b>TOTAL</b></td>
        </tr>
        </thead>
        <tbody>
            @foreach($liquidacion->getVehiculos()->all() as $vehiculo)
            <tr>
                <td style="border: 1px solid #242f59">{{ $vehiculo->getPlaca()->value() }}</td>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                    @php
                        $encontrado = array_filter($liquidacion->getEgresoTotalPorVehiculo(), function ($obj) use ($fechas, $vehiculo) {
                          return $obj->getFecha()->value() == $fechas->format('Y-m-d') && $obj->getIdVehiculo()->value() === $vehiculo->getId()->value();
                        });
                         $encontrado = (count($encontrado) > 0) ? reset($encontrado) : null;
                    @endphp
                    <td style="border: 1px solid #242f59">{{ !is_null($encontrado) ? $encontrado->getTotal()->value() : 0 }}</td>
                @endforeach
                @php
                    $totalIngresoVehiculo = 0;
                    foreach ($liquidacion->getEgresoTotalPorVehiculo() as $item) {
                        $totalIngresoVehiculo += $item->getIdVehiculo()->value() === $vehiculo->getId()->value() ? $item->getTotal()->value() : 0;
                    }
                @endphp
                <td style="border: 1px solid #242f59"><b>{{ $totalIngresoVehiculo }}</b></td>
            </tr>
            @endforeach
            <tr>
                @foreach($liquidacion->getFechaPeriodo() as $fechas)
                    <td></td>
                @endforeach
                <td style="border: 1px solid #242f59"><b>EGRESOS</b></td>
                @php
                    $totalEgreso = 0;
                    foreach ($liquidacion->getEgresoTotalPorVehiculo() as $item) {
                        $totalEgreso +=  $item->getTotal()->value();
                    }
                @endphp
                <td style="border: 1px solid #242f59"><b>{{ $totalEgreso }}</b></td>
            </tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>

    <table class="table table-sm">
        <tbody>
            <tr>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>INGRESOS</b></td>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>{{ $totalIngreso }}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>EGRESOS</b></td>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>{{ $totalEgreso }}</b></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>SALDO TOTAL</b></td>
                <td colspan="2" style="font-size: 14px;border: 1px solid #242f59"><b>{{ $totalIngreso - $totalEgreso }}</b></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
        </tbody>
    </table>

</html>
