<?php
declare(strict_types=1);

namespace Src\TransporteInterprovincial\Destino\Domain;


use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoId;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoPlate;
use Src\TransporteInterprovincial\Destino\Domain\ValueObjects\DestinoUnit;


final class SmallDestino
{
    private  $id;
    private  $plate;
    private  $unit;

    /**
     * @param DestinoId $id
     * @param DestinoPlate $plate
     * @param DestinoUnit $unit
     */
    public function __construct(
        DestinoId $id,
        DestinoPlate $plate,
        DestinoUnit $unit
    )
    {
        $this->id = $id;
        $this->plate = $plate;
        $this->unit = $unit;
    }

    /**
     * @return DestinoId
     */
    public function getId(): DestinoId
    {
        return $this->id;
    }

    /**
     * @return DestinoPlate
     */
    public function getPlate(): DestinoPlate
    {
        return $this->plate;
    }

    /**
     * @return DestinoUnit
     */
    public function getUnit(): DestinoUnit
    {
        return $this->unit;
    }



}
