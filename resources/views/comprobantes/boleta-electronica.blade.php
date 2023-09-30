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
        @page { margin: 10px;}
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
    </style>
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />--}}
</head>
<body>
<div class="container mt-5">
    <div class="mw-80 mx-auto">
        <p class="text-center">EMPRESA NOMBRE URL S.A.C</p>
        <p class="text-center">RUC: 54646546464</p>
        <p class="text-center">DIRECCIÓN DIRECCIÓN DIRECCIÓN DIRECCIÓN 84351 LIMA - LIMA - LIMA</p>
    </div>

    <table class="w-100">
        <tr class="border-dashed-top">
            <td>OP. GRAVADA</td>
            <td></td>
            <td class="text-end">0.00</td>
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
            <td class="text-end">0.00</td>
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
            <td colspan="3">Son: CUARENTA Y DOS CON 80/100 SOLES</td>
        </tr>
    </table>
</div>
</body>
</html>
