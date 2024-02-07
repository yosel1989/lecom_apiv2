<?php

namespace Src\V2\TipoComprobante\Domain\Contracts;

interface TipoComprobanteRepositoryContract
{

    public function list(): array;
    public function listPuntoVenta(): array;
    public function listDespacho(): array;

}
