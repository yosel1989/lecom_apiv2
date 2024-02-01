<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-sm">
        <thead>
            <tr>
                <td colspan="8"><b>REPORTE TOTAL DE INGRESOS </b></td>
            </tr>
            <tr>
                <td><b>T. INGRESO</b></td>
                @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td><b>{{ $fecha->format('d/m/Y') }}</b></td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>V. BOLETOS</td>
                @foreach($liquidacion->getFechaPeriodo() as $fecha)
                    @php $total = 0;
                        foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                            if($item->getFecha()->value() === $fecha->format('Y-m-d') ){
                                $total = $item->getTotal()->value();
                            }
                        }
                    @endphp
                    <td>{{ $total }}</td>
                @endforeach
            </tr>
            <tr></tr>
            <tr>
                <td><b>TOTAL INGRESOS</b></td>
                @php
                    $total = 0;
                    foreach ($liquidacion->getIngresoTotalBoleto()->all() as $item) {
                        $total += $item->getTotal()->value();
                    }
                @endphp
                <td><b>{{ $total }}</b></td>
            </tr>
            <tr></tr>
        </tbody>
    </table>

    <table class="table table-sm">
        <thead>
        <tr>
            <td colspan="8"><b>REPORTE TOTAL DE EGRESOS </b></td>
        </tr>
        <tr>
            <td><b>T. EGRESO</b></td>
            @foreach($liquidacion->getFechaPeriodo() as $fecha)
                <td><b>{{ $fecha->format('d/m/Y') }}</b></td>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($liquidacion->getEgresoTipos()->all() as $tipoEgreso)
            <tr>
                <td class="text-uppercase">{{ strtoupper($tipoEgreso->getNombre()->value()) }}</td>
                @foreach($liquidacion->getFechaPeriodo() as $fecha)
                    @php $total = 0;
                        foreach ($liquidacion->getEgresoTotal()->all() as $item) {
                            if($item->getFecha()->value() === $fecha->format('Y-m-d') && $item->getIdEgresoTipo()->value() === $tipoEgreso->getId()->value()){
                                $total = $item->getTotal()->value();
                            }
                        }
                    @endphp
                    <td>{{ $total }}</td>
                @endforeach
            </tr>
        @endforeach
        <tr>
            <td></td>
            @foreach($liquidacion->getFechaPeriodo() as $fecha)
                @php
                    $total = 0;
                    foreach ($liquidacion->getEgresoTotal()->all() as $item) {
                        if($item->getFecha()->value() === $fecha->format('Y-m-d')){
                            $total += $item->getTotal()->value();
                        }
                    }
                @endphp
                <td><b>{{ $total }}</b></td>
            @endforeach
        </tr>
        <tr>
            <td><b>TOTAL EGRESOS</b></td>
            @php
                $total = 0;
                foreach ($liquidacion->getEgresoTotal()->all() as $item) {
                    $total += $item->getTotal()->value();
                }
            @endphp
            <td><b>{{ $total }}</b></td>
        </tr>
        <tr></tr>
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
</body>
</html>
