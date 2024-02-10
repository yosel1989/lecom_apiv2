<?php

namespace Src\V2\ComprobanteElectronicoItem\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\Core\Domain\ValueObjects\NumericInteger;
use Src\Core\Domain\ValueObjects\Text;
use Src\V2\BoletoInterprovincial\Domain\BoletoInterprovincialOficial;
use Src\V2\ComprobanteElectronico\Domain\ComprobanteElectronico;
use Src\V2\ComprobanteElectronicoItem\Domain\ComprobanteElectronicoItem;
use Src\V2\ComprobanteElectronicoItem\Domain\Contracts\ComprobanteElectronicoItemRepositoryContract;

final class CreateToBoletoUseCase
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
        BoletoInterprovincialOficial $boleto,
        ComprobanteElectronico $comprobante,
        Id $idUsuarioRegistro
    ): ComprobanteElectronicoItem
    {
        return $this->repository->createToBoleto(
            $boleto,
            $comprobante,
            $idUsuarioRegistro
        );
    }
}
