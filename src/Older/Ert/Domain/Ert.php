<?php

declare(strict_types=1);

namespace Src\Older\Ert\Domain;


use Src\Older\Ert\Domain\ValueObjects\ErtId;
use Src\Older\Ert\Domain\ValueObjects\ErtImei;
use Src\Older\Ert\Domain\ValueObjects\ErtVehiculoId;

final class Ert
{
    /**
     * @var ErtId
     */
    private $id;
    /**
     * @var ErtImei
     */
    private $imei;
    /**
     * @var ErtVehiculoId
     */
    private $vehiculoId;

    /**
     * Ert constructor.
     * @param ErtId $id
     * @param ErtImei $imei
     * @param ErtVehiculoId $vehiculoId
     */
    public function __construct(
        ErtId $id,
        ErtImei $imei,
        ErtVehiculoId $vehiculoId
    )
    {
        $this->id = $id;
        $this->imei = $imei;
        $this->vehiculoId = $vehiculoId;
    }

    /**
     * @return ErtId
     */
    public function getId(): ErtId
    {
        return $this->id;
    }

    /**
     * @return ErtImei
     */
    public function getImei(): ErtImei
    {
        return $this->imei;
    }

    /**
     * @return ErtVehiculoId
     */
    public function getVehiculoId(): ErtVehiculoId
    {
        return $this->vehiculoId;
    }


}
