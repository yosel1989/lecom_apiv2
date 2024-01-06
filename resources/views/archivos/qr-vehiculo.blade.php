<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">--}}
    <style>
        @page { margin-top: 0px; margin-bottom: 0px; }
        @media dompdf {
            /* your styles here */
        }
        *{
            padding: 0;
            margin: 0;
            max-width: 100%;
            font-size: 50px !important;
            box-sizing: border-box;
            page-break-inside: avoid;
            font-family: 'Arial','sans-serif'
        }
        .fs-6px{
            font-size: 6px !important;
        }
        .fs-26px{
            font-size: 26px !important;
        }
        html,
        body {
            height: 100%;
            margin: 0;
            page-break-inside: avoid;
            display: flex;
            flex-direction: column;
        }
        .container{
            page-break-inside: avoid;
            margin: 1rem;
        }
        body{
            /*margin: 10px;*/
            /*page-break-before: auto;*/
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
    <div style="width: 500px; margin-right: auto; margin-left: auto; border: 2px solid #000000; border-radius: 10px; padding: 15px;">
        <p style="text-align: center; font-size: 100px; font-weight: bold; margin-bottom: 15px">{{ $vehicle->getPlaca()->value() }}</p>
        <img src="data:image/png;base64, {{ $qrcode }}" alt="" width="500" height="500" style="display:block; margin:0;" >
    </div>

</div>
</body>
</html>
