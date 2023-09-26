<?php

namespace Src\V2\ComprobanteSerie\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerie;

interface ComprobanteSerieRepositoryContract
{

    public function create(
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function update(
        Id $id,
        Text $nombre,
        NumericInteger $idTipoComprobante,
        Id $idCliente,
        Id $idSede,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;

    public function changeState(
        Id $id,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $id,
    ): ComprobanteSerie;

}
