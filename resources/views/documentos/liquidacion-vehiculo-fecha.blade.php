<html lang="es">

@foreach($liquidacion->getFechaPeriodo() as $fechas)
    <tr>
        <th colspan="8" style="font-size: 14px; background: #9d9d9d; border: 1px solid #242f59"><b>{{ $utilidades->dia($fechas->format('N')) }}, {{ $fechas->format('d \d\e') }} {{ $utilidades->mes($fechas->format('m')) }} {{ $fechas->format('\d\e\l Y') }}</b></th>
    </tr>

    <tr>
        <th colspan="2" style="border: 1px solid #242f59"><b>FECHA</b></th>
        <th colspan="6" style="border: 1px solid #242f59"><b>{{ $utilidades->dia($fechas->format('N')) }}, {{ $fechas->format('d \d\e') }} {{ $utilidades->mes($fechas->format('m')) }} {{ $fechas->format('\d\e\l Y') }}</b></th>
    </tr>
    <tr>
        <th colspan="2" style="border: 1px solid #242f59"><b>RUTA</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>BOLETOS</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>PRECIO</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>TOTAL</b></th>
    </tr>
    @php
        $totalCantidad = 0;
        $totalIngreso = 0;
    @endphp
    @foreach($liquidacion->getIngresoTotalBoletoPorVehiculo() as $ingreso)
    @if($ingreso->getIdVehiculo()->value() === $vehiculo->getId()->value() && $ingreso->getFecha()->value() === $fechas->format('Y-m-d') )
        @php
            $totalCantidad += $ingreso->getCantidad()->value();
            $totalIngreso += $ingreso->getTotal()->value();
        @endphp
    <tr>
        <td colspan="2"  style="border: 1px solid #242f59">{{ $ingreso->getRuta()->value() }}</td>
        <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getCantidad()->value() }}</td>
        <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getPrecio()->value() }}</td>
        <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getTotal()->value() }}</td>
    </tr>
    @endif
    @endforeach
    <tr>
        <td colspan="2"></td>
        <td colspan="2" style="border: 1px solid #242f59; background: #dcdcdc">{{ $totalCantidad }}</td>
        <td colspan="2"></td>
        <td colspan="2" style="border: 1px solid #242f59; background: #e0d78b">{{ $totalIngreso }}</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
@endforeach

</html>

<html lang="es">

@foreach($liquidacion->getFechaPeriodo() as $fechas)
    <tr>
        <th colspan="8" style="font-size: 14px; background: #9d9d9d; border: 1px solid #242f59"><b>{{ $utilidades->dia($fechas->format('N')) }}, {{ $fechas->format('d \d\e') }} {{ $utilidades->mes($fechas->format('m')) }} {{ $fechas->format('\d\e\l Y') }}</b></th>
    </tr>

    <tr>
        <th colspan="2" style="border: 1px solid #242f59"><b>FECHA</b></th>
        <th colspan="6" style="border: 1px solid #242f59"><b>{{ $utilidades->dia($fechas->format('N')) }}, {{ $fechas->format('d \d\e') }} {{ $utilidades->mes($fechas->format('m')) }} {{ $fechas->format('\d\e\l Y') }}</b></th>
    </tr>
    <tr>
        <th colspan="2" style="border: 1px solid #242f59"><b>RUTA</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>BOLETOS</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>PRECIO</b></th>
        <th colspan="2" style="border: 1px solid #242f59"><b>TOTAL</b></th>
    </tr>
    @php
        $totalCantidad = 0;
        $totalIngreso = 0;
    @endphp
    @foreach($liquidacion->getIngresoTotalBoletoPorVehiculo() as $ingreso)
        @if($ingreso->getIdVehiculo()->value() === $vehiculo->getId()->value() && $ingreso->getFecha()->value() === $fechas->format('Y-m-d') )
            @php
                $totalCantidad += $ingreso->getCantidad()->value();
                $totalIngreso += $ingreso->getTotal()->value();
            @endphp
            <tr>
                <td colspan="2"  style="border: 1px solid #242f59">{{ $ingreso->getRuta()->value() }}</td>
                <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getCantidad()->value() }}</td>
                <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getPrecio()->value() }}</td>
                <td colspan="2" style="border: 1px solid #242f59">{{ $ingreso->getTotal()->value() }}</td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td colspan="2"></td>
        <td colspan="2" style="border: 1px solid #242f59; background: #dcdcdc">{{ $totalCantidad }}</td>
        <td colspan="2"></td>
        <td colspan="2" style="border: 1px solid #242f59; background: #e0d78b">{{ $totalIngreso }}</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
@endforeach

</html>
