<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Domain;


use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDeleted;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDetail;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardId;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardImei;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardNumber;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardStatus;

final class SimCard
{
    /**
     * @var SimCardId
     */
    private $id;
    /**
     * @var SimCardNumber
     */
    private $number;
    /**
     * @var SimCardDeleted
     */
    private $deleted;
    /**
     * @var OperatorPhoneId
     */
    private $idOperator;
    /**
     * @var OperatorPhone
     */
    private $operator;
    /**
     * @var SimCardStatus
     */
    private $status;
    /**
     * @var SimCardDetail
     */
    private $detail;
    /**
     * @var ClientId
     */
    private $idClient;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var SimCardImei
     */
    private $imei;

    /**
     * SimCard constructor.
     * @param SimCardId $id
     * @param SimCardNumber $number
     * @param SimCardImei $imei
     * @param SimCardDeleted $deleted
     * @param SimCardStatus $status
     * @param SimCardDetail $detail
     * @param OperatorPhoneId $idOperator
     * @param ClientId $idClient
     */
    public function __construct(
        SimCardId  $id,
        SimCardNumber $number,
        SimCardImei $imei,
        SimCardDeleted $deleted,
        SimCardStatus $status,
        SimCardDetail $detail,
        OperatorPhoneId $idOperator,
        ClientId $idClient
    )
    {
        $this->id = $id;
        $this->number = $number;
        $this->deleted = $deleted;
        $this->idOperator = $idOperator;
        $this->status = $status;
        $this->detail = $detail;
        $this->idClient = $idClient;
        $this->imei = $imei;
    }

    /**
     * @return SimCardId
     */
    public function getId(): SimCardId
    {
        return $this->id;
    }

    /**
     * @return SimCardNumber
     */
    public function getNumber(): SimCardNumber
    {
        return $this->number;
    }

    /**
     * @return SimCardDeleted
     */
    public function getDeleted(): SimCardDeleted
    {
        return $this->deleted;
    }

    /**
     * @return OperatorPhoneId
     */
    public function getIdOperator(): OperatorPhoneId
    {
        return $this->idOperator;
    }

    /**
     * @return SimCardStatus
     */
    public function getStatus(): SimCardStatus
    {
        return $this->status;
    }

    /**
     * @return SimCardDetail
     */
    public function getDetail(): ?SimCardDetail
    {
        return $this->detail;
    }



    /**
     * @return OperatorPhone|null
     */
    public function getOperator(): ?OperatorPhone
    {
        return $this->operator;
    }

    /**
     * @param OperatorPhone|null $operator
     */
    public function setOperator(?OperatorPhone $operator): void
    {
        $this->operator = $operator;
    }

    /**
     * @return ClientId
     */
    public function getIdClient(): ClientId
    {
        return $this->idClient;
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

    /**
     * @return SimCardImei
     */
    public function getImei(): SimCardImei
    {
        return $this->imei;
    }




    public static function createEntity( $request ): SimCard
    {
        return new self(
            new SimCardId ( $request->id ),
            new SimCardNumber( $request->number ),
            new SimCardImei( $request->imei ),
            new SimCardDeleted( $request->deleted ),
            new SimCardStatus( $request->status ),
            new SimCardDetail( $request->detail ),
            new OperatorPhoneId( $request->id_telephone_operator ),
            new ClientId( $request->id_client )
        );
    }

}
