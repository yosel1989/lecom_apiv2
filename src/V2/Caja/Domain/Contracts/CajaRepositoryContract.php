<?php

namespace Src\V2\Caja\Domain\Contracts;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\Caja\Domain\Caja;
use Src\V2\Caja\Domain\CajaSede;

interface CajaRepositoryContract
{
    public function create(
        Text $nombre,
        Id $idCliente,
        Id $idSede,
        Id $idPos,
        ValueBoolean $blPuntoVenta,
        ValueBoolean $blDespacho,
        ValueBoolean $blPrincipal,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function collectionByCliente(Id $idCliente): array;
    public function listByCliente(Id $idCliente): array;
    public function listBySede(Id $idCliente, Id $idSede): array;
    public function listBySedeDespacho(Id $idCliente, Id $idSede): array;
    public function listBySedePuntoVenta(Id $idCliente, Id $idSede): array;
    public function listPrincipalBySede(Id $idCliente, Id $idSede): array;

    public function update(
        Id $id,
        Text $nombre,
        Id $idSede,
        Id $idPos,
        ValueBoolean $blPuntoVenta,
        ValueBoolean $blDespacho,
        ValueBoolean $blPrincipal,
        NumericInteger $idEstado,
        Id $idUsuarioRegistro
    ): void;

    public function changeState(
        Id $idCaja,
        NumericInteger $idEstado,
        Id $idUsuarioModifico
    ): void;

    public function find(
        Id $idCaja,
    ): Caja;

    public function findToDespacho(
        Id $idCaja,
        Id $idCajaDiario,
    ): CajaSede;

    public function findToPuntoVenta(
        Id $idCaja,
        Id $idCajaDiario,
    ): CajaSede;
}
