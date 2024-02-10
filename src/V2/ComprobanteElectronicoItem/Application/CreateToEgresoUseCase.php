<?php

namespace Src\V2\ComprobanteElectronicoItem\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItem;
use Src\V2\ComprobanteElectronicoItem\Domain\Contracts\ComprobanteElectronicoItemRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;
use Src\V2\EgresoDetalle\Domain\EgresoDetalle;

final class CreateToEgresoUseCase
{
    /**
     * @var ComprobanteElectronicoItemRepositoryContract
     */
    private ComprobanteElectronicoItemRepositoryContract $repository;

    public function __construct( ComprobanteElectronicoItemRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?int $idTipoDocumento,
        ?string $numeroDocumento,
        ?string $nombre,
        ?string $direccion,
        string $idUsuario,
        Egreso $egreso,
        EgresoDetalle $egresoDetalle
    ): ComprobanteElectronicoItem
    {
        return $this->repository->createToEgreso(
            new NumericInteger($idTipoDocumento),
            new Text($numeroDocumento, false, 15, 'El numero de documento excede los 15 caracteres'),
            new Text($nombre, false, 100, 'El numero de documento excede los 100 caracteres'),
            new Text($direccion, true, 100, 'El numero de documento excede los 100 caracteres'),
            new Id($idUsuario, false, 'El id del usuario no tiene el formato correcto'),
            $egreso,
            $egresoDetalle
        );
    }
}
