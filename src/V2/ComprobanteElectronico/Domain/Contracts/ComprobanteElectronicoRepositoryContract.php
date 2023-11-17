<?php

namespace Src\V2\ComprobanteElectronico\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;

interface ComprobanteElectronicoRepositoryContract
{

    public function createToBoleto(
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        BoletoInterprovincialOficial $boleto
    ): ComprobanteElectronico;

}
