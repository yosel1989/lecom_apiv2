<?php
declare(strict_types=1);

namespace Src\Admin\Ert\Domain;


use Src\Admin\Client\Domain\Client;
use Src\Admin\Ert\Domain\ValueObjects\ErtId;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdClient;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdGps;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdSim;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdType;
use Src\Admin\Ert\Domain\ValueObjects\ErtIdVehicle;
use Src\Admin\Ert\Domain\ValueObjects\ErtPeriod;
use Src\Admin\Ert\Domain\ValueObjects\ErtSutran;
use Src\Admin\Gps\Domain\Gps;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\Vehicle\Domain\Vehicle;

final class Ert
{
    /**
     * @var ErtId
     */
    private $id;
    /**
     * @var ErtPeriod
     */
    private $period;
    /**
     * @var ErtSutran
     */
    private $sutran;
    /**
     * @var ErtIdClient
     */
    private $idClient;
    /**
     * @var ErtIdVehicle
     */
    private $idVehicle;
    /**
     * @var ErtIdType
     */
    private $idType;
    /**
     * @var ErtIdGps
     */
    private $idGps;
    /**
     * @var ErtIdSim
     */
    private $idSim;
    /**
     * @var Client | null
     */
    private $client;
    /**
     * @var Vehicle | null
     */
    private $vehicle;
    /**
     * @var SimCard | null
     */
    private $simCard;
    /**
     * @var Gps | null
     */
    private $gps;

    /**
     * Ert constructor.
     * @param ErtId $id
     * @param ErtPeriod $period
     * @param ErtSutran $sutran
     * @param ErtIdClient $idClient
     * @param ErtIdVehicle $idVehicle
     * @param ErtIdType $idType
     * @param ErtIdGps $idGps
     * @param ErtIdSim $idSim
     */
    public function __construct(
        ErtId $id,
        ErtPeriod $period,
        ErtSutran $sutran,
        ErtIdClient $idClient,
        ErtIdVehicle $idVehicle,
        ErtIdType $idType,
        ErtIdGps $idGps,
        ErtIdSim $idSim
    )
    {
        $this->id = $id;
        $this->period = $period;
        $this->sutran = $sutran;
        $this->idClient = $idClient;
        $this->idVehicle = $idVehicle;
        $this->idType = $idType;
        $this->idGps = $idGps;
        $this->idSim = $idSim;
    }

    /**
     * @return ErtId
     */
    public function getId(): ErtId
    {
        return $this->id;
    }

    /**
     * @return ErtPeriod
     */
    public function getPeriod(): ErtPeriod
    {
        return $this->period;
    }

    /**
     * @return ErtSutran
     */
    public function getSutran(): ErtSutran
    {
        return $this->sutran;
    }


    /**
     * @return ErtIdClient
     */
    public function getIdClient(): ErtIdClient
    {
        return $this->idClient;
    }

    /**
     * @return ErtIdVehicle
     */
    public function getIdVehicle(): ErtIdVehicle
    {
        return $this->idVehicle;
    }

    /**
     * @return ErtIdType
     */
    public function getIdType(): ErtIdType
    {
        return $this->idType;
    }

    /**
     * @return ErtIdGps
     */
    public function getIdGps(): ErtIdGps
    {
        return $this->idGps;
    }

    /**
     * @return ErtIdSim
     */
    public function getIdSim(): ErtIdSim
    {
        return $this->idSim;
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    /**
     * @param Client|null $client
     */
    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return Vehicle|null
     */
    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    /**
     * @param Vehicle|null $vehicle
     */
    public function setVehicle(?Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return SimCard|null
     */
    public function getSimCard(): ?SimCard
    {
        return $this->simCard;
    }

    /**
     * @param SimCard|null $simCard
     */
    public function setSimCard(?SimCard $simCard): void
    {
        $this->simCard = $simCard;
    }

    /**
     * @return Gps|null
     */
    public function getGps(): ?Gps
    {
        return $this->gps;
    }

    /**
     * @param Gps|null $gps
     */
    public function setGps(?Gps $gps): void
    {
        $this->gps = $gps;
    }





    public static function createEntity( $request ): Ert
    {
        return new self(
            new ErtId( $request->id ),
            new ErtPeriod( $request->period ),
            new ErtSutran( $request->sutran ),
            new ErtIdClient( $request->id_client ),
            new ErtIdVehicle( $request->id_vehicle ),
            new ErtIdType( $request->id_type ),
            new ErtIdGps( $request->id_gps ),
            new ErtIdSim( $request->id_sim )
        );
    }

}
