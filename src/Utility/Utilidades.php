<?php

declare(strict_types=1);

namespace Src\Utility;

final class Utilidades
{


    public function __construct()
    {
    }


    function mesCorto(int $mes): string {
        $output = '';
        switch ($mes){
            case 1: $output = 'Ene'; break;
            case 2: $output = 'Feb'; break;
            case 3: $output = 'Mar'; break;
            case 4: $output = 'Abr'; break;
            case 5: $output = 'May'; break;
            case 6: $output = 'Jun'; break;
            case 7: $output = 'Jul'; break;
            case 8: $output = 'Ago'; break;
            case 9: $output = 'Set'; break;
            case 10: $output = 'Oct'; break;
            case 11: $output = 'Nov'; break;
            case 12: $output = 'Dic'; break;
            default; break;
        }

        return $output;
    }

    function mes(int $mes): string {
        $output = '';
        switch ($mes){
            case 1: $output = 'Enero'; break;
            case 2: $output = 'Febrero'; break;
            case 3: $output = 'Marzo'; break;
            case 4: $output = 'Abril'; break;
            case 5: $output = 'Mayo'; break;
            case 6: $output = 'Junio'; break;
            case 7: $output = 'Julio'; break;
            case 8: $output = 'Agosto'; break;
            case 9: $output = 'Setiembre'; break;
            case 10: $output = 'Octubre'; break;
            case 11: $output = 'Noviembre'; break;
            case 12: $output = 'Diciembre'; break;
            default; break;
        }

        return $output;
    }


    function dia(int $diaSemana): string {
        $output = '';
        switch ($diaSemana){
            case 1: $output = 'Lunes'; break;
            case 2: $output = 'Martes'; break;
            case 3: $output = 'Miércoles'; break;
            case 4: $output = 'Jueves'; break;
            case 5: $output = 'Viernes'; break;
            case 6: $output = 'Sábado'; break;
            case 7: $output = 'Domingo'; break;
            default; break;
        }

        return $output;
    }



}
