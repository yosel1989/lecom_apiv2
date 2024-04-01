<?php

namespace Src\V2\ComprobanteElectronico\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\Core\Domain\ValueObjects\ValueBoolean;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronico\Domain\Contracts\ComprobanteElectronicoRepositoryContract;

final class CreateToBoletoUseCase
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
        bool $editarEntidad,
        ?string $numeroDocumento,
        ?string $nombre,
        ?string $direccion,
        string $idUsuario,
        BoletoInterprovincialOficial $boleto
    ): ComprobanteElectronico
    {
        return $this->repository->createToBoleto(
            new NumericInteger($idTipoDocumento, true),
            new ValueBoolean($editarEntidad),
            new Text($numeroDocumento, true, 15, 'El numero de documento excede los 15 caracteres'),
            new Text($nombre, true, 100, 'El numero de documento excede los 100 caracteres'),
            new Text($direccion, true, 100, 'El numero de documento excede los 100 caracteres'),
            new Id($idUsuario, false, 'El id del usuario no tiene el formato correcto'),
            $boleto
        );
    }
}
