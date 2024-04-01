<?php

namespace Src\V2\ComprobanteElectronico\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;

interface ComprobanteElectronicoRepositoryContract
{

    public function createToBoleto(
        NumericInteger $idTipoDocumento,
        ValueBoolean $editarEntidad,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        BoletoInterprovincialOficial $boleto
    ): ComprobanteElectronico;

    public function createToEgreso(
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        Egreso $egreso,
    ): ComprobanteElectronico;

}
