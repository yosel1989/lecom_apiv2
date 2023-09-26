<?php

namespace Src\V2\ComprobanteSerie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericFloat;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;

final class UpdateUseCase
{
    /**
     * @var ComprobanteSerieRepositoryContract
     */
    private ComprobanteSerieRepositoryContract $repository;

    public function __construct( ComprobanteSerieRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $nombre,
        int $idTipoComprobante,
        string $idCliente,
        string $idSede,
        int $idEstado,
        string $idUsuarioRegistro
    ): void
    {
        $_id = new Id($id,false,'El id no tiene el formato correcto');
        $_nombre = new Text($nombre,false, 100,'El nombre de la ComprobanteSerie excede los 100 caracteres');
        $_idTipoComprobante = new NumericInteger($idTipoComprobante);
        $_idCliente = new Id($idCliente,false,'El id del cliente no tiene el formato correcto');
        $_idSede = new Id($idSede,false,'El id de la sede no tiene el formato correcto');
        $_idEstado = new NumericInteger($idEstado);
        $_idUsuarioRegistro = new Id($idUsuarioRegistro,false,'El id del usuario no tiene el formato correcto');

        $this->repository->update(
            $_id,
            $_nombre,
            $_idTipoComprobante,
            $_idCliente,
            $_idSede,
            $_idEstado,
            $_idUsuarioRegistro
        );

    }
}
