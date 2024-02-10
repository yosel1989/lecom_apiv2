<?php

namespace Src\V2\ComprobanteElectronicoItem\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItem;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;

interface ComprobanteElectronicoItemRepositoryContract
{

    public function createToBoleto(
        BoletoInterprovincialOficial $boleto,
        ComprobanteElectronico $comprobante,
        Id $idUsuarioRegistro
    ): ComprobanteElectronicoItem;

    public function createToEgreso(
        NumericInteger $idTipoDocumento,
        Text $numeroDocumento,
        Text $nombre,
        Text $direccion,
        Id $idUsuario,
        Egreso $egreso,
        EgresoDetalle $egresoDetalle
    ): ComprobanteElectronicoItem;

}
