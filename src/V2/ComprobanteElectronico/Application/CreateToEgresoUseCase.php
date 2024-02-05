<?php

namespace Src\V2\ComprobanteElectronico\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronico\Domain\Contracts\ComprobanteElectronicoRepositoryContract;
use Src\V2\Egreso\Domain\Egreso;

final class CreateToEgresoUseCase
{
    /**
     * @var ComprobanteElectronicoRepositoryContract
     */
    private ComprobanteElectronicoRepositoryContract $repository;

    public function __construct( ComprobanteElectronicoRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        ?int $idTipoDocumento,
        ?string $numeroDocumento,
        ?string $nombre,
//        ?string $direccion,
        string $idUsuario,
        Egreso $egreso
    ): ComprobanteElectronico
    {
        return $this->repository->createToEgreso(
            new NumericInteger($idTipoDocumento, true),
            new Text($numeroDocumento, true, 15, 'El numero de documento excede los 15 caracteres'),
            new Text($nombre, true, 100, 'El numero de documento excede los 100 caracteres'),
//            new Text($direccion, true, 100, 'El numero de documento excede los 100 caracteres'),
            new Id($idUsuario, false, 'El id del usuario no tiene el formato correcto'),
            $egreso
        );
    }
}
