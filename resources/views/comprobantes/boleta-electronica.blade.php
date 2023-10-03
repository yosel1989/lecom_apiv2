<?php
$medidaTicket = 180;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">--}}
    <style>
        @page { margin: 10px; margin-top: 0px; margin-bottom: 0px;}
        *{
            padding: 0;
            margin: 0;
            max-width: 100%;
            font-size: 8px;
            box-sizing: border-box;
        }
        body{
            margin: 10px;
        }
        .border-dashed-top{
            border-top: 1px dashed #000000;
        }
        .text-end{
            text-align: right;
        }
        .text-uppercase{
            text-transform: uppercase;
        }
        table{ border-spacing: 0 !important; width: 100%; border-collapse: collapse; }
        .text-center{
            text-align: center;
        }
        .mw-80{
            max-width: 80%;
        }
        .mx-auto{
            margin-left: auto;
            margin-right: auto;
        }
        .mt-1{
            margin-top: .5rem;
        }
        .mb-1{
            margin-bottom: .5rem;
        }
        .my-1{
            margin-bottom: .5rem;
            margin-top: .5rem;
        }
        .mt-2{
            margin-top: 1rem;
        }
        .mb-2{
            margin-bottom: 1rem;
        }
        .my-2{
            margin-bottom: 1rem;
            margin-top: 1rem;
        }
        .mt-3{
            margin-top: 1.5rem;
        }
        .mb-3{
            margin-bottom: 1.5rem;
        }
        .my-3{
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;
        }
    </style>
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />--}}
</head>
<body>
<div class="container mt-5">
    <div class="mw-80 mx-auto">
        <img src="data:image/png;base64,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" alt="" width="100%" height="auto">
        <p class="text-center">EMPRESA NOMBRE URL S.A.C</p>
        <p class="text-center">RUC: 54646546464</p>
        <p class="text-center">DIRECCIÓN DIRECCIÓN DIRECCIÓN DIRECCIÓN 84351 LIMA - LIMA - LIMA</p>
    </div>

    <div class="border-dashed-top w-100 my-1"></div>
    <p class="text-center text-uppercase"><b>{{ $boleto->getTipoComprobante()->value() }}</b></p>
    <p class="text-center text-uppercase"><b>B001-00000001</b></p>
    <div class="border-dashed-top w-100 my-1"></div>

    <table class="w-100">
        <tr>
            <td>RUTA</td>
            <td></td>
            <td class="text-end text-uppercase">{{ $boleto->getRuta()->value()  }}</td>
        </tr>
        <tr>
            <td>DESTINO</td>
            <td></td>
            <td class="text-end text-uppercase">{{ $boleto->getParadero()->value() }}</td>
        </tr>
        <tr>
            <td>PRECIO</td>
            <td></td>
            <td class="text-end">S/ {{ number_format($boleto->getPrecio()->value(), 2, '.', '') }}</td>
        </tr>
        <tr>
            <td>CAJA</td>
            <td></td>
            <td class="text-end">{{ $boleto->getCaja()->value()  }}</td>
        </tr>
        <tr>
            <td>PASAJERO</td>
            <td></td>
            <td class="text-end">{{ $boleto->getNombres()->value() }} {{ $boleto->getApellidos()->value() }} </td>
        </tr>
        <tr>
            <td>T. DOCUMENTO</td>
            <td></td>
            <td class="text-end text-uppercase">{{ $boleto->getTipoDocumento()->value() }}</td>
        </tr>
        <tr>
            <td>N°. DOCUMENTO</td>
            <td></td>
            <td class="text-end text-uppercase">{{ $boleto->getNumeroDocumento()->value() }}</td>
        </tr>
    </table>
    <div class="border-dashed-top w-100 my-1"></div>
    <table class="w-100">
        <tr>
            <td>OP. GRAVADA</td>
            <td></td>
            <td class="text-end">{{ number_format($boleto->getPrecio()->value(), 2, '.', '') }}</td>
        </tr>
        <tr>
            <td>EXONERADA</td>
            <td></td>
            <td class="text-end">{{ number_format($boleto->getPrecio()->value(), 2, '.', '') }}</td>
        </tr>
        <tr>
            <td>I.G.V</td>
            <td></td>
            <td class="text-end">0.00</td>
        </tr>
        <tr>
            <td>RECARGO CONSUMO</td>
            <td></td>
            <td class="text-end">0.00</td>
        </tr>
        <tr>
            <td>ICBPER</td>
            <td></td>
            <td class="text-end">0.00</td>
        </tr>
        <tr>
            <td>IMPORTE TOTAL</td>
            <td></td>
            <td class="text-end">S/ {{ number_format($boleto->getPrecio()->value(), 2, '.', '') }}</td>
        </tr>
        <tr>
            <td>Efectivo</td>
            <td></td>
            <td class="text-end">0.00</td>
        </tr>
        <tr>
            <td>VUELTO</td>
            <td></td>
            <td class="text-end">0.00</td>
        </tr>
        <tr>
            <td colspan="3"><b>IMPORTE EN LETRAS:</b> {{  $formatter->toInvoice($boleto->getPrecio()->value(), 2, 'SOLES', 'CENTIMOS') }}</td>
        </tr>
        <tr>
            <td colspan="3"><b>FORMA DE PAGO:</b> EFECTIVO[CONTADO]</td>
        </tr>
    </table>
    <div class="border-dashed-top w-100 my-1"></div>
    <div class="w-100 text-center">
        <p>Representación impresa de la <span class="text-uppercase">{{ $boleto->getTipoComprobante()->value()  }}</span>, visita cpe.lecomperu.com/99999999999999</p>
        <p>Autorizado mediante Resolución de Intendencia No.034-005-0005315</p>
    </div>
</div>
</body>
</html>
