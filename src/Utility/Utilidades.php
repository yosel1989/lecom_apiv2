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



}
