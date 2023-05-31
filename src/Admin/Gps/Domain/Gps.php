<?php

declare(strict_types=1);

namespace Src\Admin\Gps\Domain;


use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\Gps\Domain\ValueObjects\GpsId;
use Src\Admin\Gps\Domain\ValueObjects\GpsIdModel;
use Src\Admin\Gps\Domain\ValueObjects\GpsImei;
use Src\Admin\Gps\Domain\ValueObjects\GpsType;
use Src\Admin\GpsModel\Domain\GpsModel;

final class Gps
{
    /**
     * @var GpsId
     */
    private $id;
    /**
     * @var GpsImei
     */
    private $imei;
    /**
     * @var GpsIdModel
     */
    private $idModel;
    /**
     * @var GpsModel | null
     */
    private $gpsModel;
    /**
     * @var GpsType
     */
    private $type;
    /**
     * @var ClientId
     */
    private $idClient;
    /**
     * @var Client
     */
    private $client;

    /**
     * Gps constructor.
     * @param GpsId $id
     * @param GpsImei $imei
     * @param GpsType $type
     * @param ClientId $idClient
     * @param GpsIdModel $idModel
     */
    public function __construct(
        GpsId  $id,
        GpsImei $imei,
        GpsType $type,
        ClientId $idClient,
        GpsIdModel $idModel
    )
    {

        $this->id = $id;
        $this->imei = $imei;
        $this->idModel = $idModel;
        $this->type = $type;
        $this->idClient = $idClient;
    }

    /**
     * @return GpsId
     */
    public function getId(): GpsId
    {
        return $this->id;
    }

    /**
     * @return GpsImei
     */
    public function getImei(): GpsImei
    {
        return $this->imei;
    }


    /**
     * @return GpsIdModel
     */
    public function getIdModel(): GpsIdModel
    {
        return $this->idModel;
    }

    /**
     * @return GpsType
     */
    public function getType(): GpsType
    {
        return $this->type;
    }

    /**
     * @return ClientId
     */
    public function getIdClient(): ClientId
    {
        return $this->idClient;
    }


    /**
     * @return GpsModel|null
     */
    public function getGpsModel(): ?GpsModel
    {
        return $this->gpsModel;
    }

    /**
     * @param GpsModel|null $gpsModel
     */
    public function setGpsModel(?GpsModel $gpsModel): void
    {
        $this->gpsModel = $gpsModel;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }


    public static function createEntity( $request ): Gps
    {
        return new self(
            new GpsId( $request->id ),
            new GpsImei( $request->imei ),
            new GpsType( $request->type ),
            new ClientId( $request->id_client),
            new GpsIdModel( $request->id_gps_model )
        );
    }

}
