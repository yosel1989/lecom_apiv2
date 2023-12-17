<?php

namespace App\Enums;

enum EnumTipoMenu: int
{
    case Titulo = 1;
    case Subtitulo = 2;
    case Link = 3;
    case SubMenu = 4;
}
