<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Domain;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMIdType;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMName;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMShortName;
use Src\Utility\UDateTime;

final class ColdMachineModel
{
    /**
     * @var CMMId
     */
    private $id;
    /**
     * @var CMMName
     */
    private $name;
    /**
     * @var CMMShortName
     */
    private $shortName;
    /**
     * @var CMMIdType
     */
    private $idType;

    /**
     * @var CMMCode
     */
    private $code;
    /**
     * @var UserId
     */
    private $idUserCreated;
    /**
     * @var UserId|null
     */
    private $idUserUpdated;
    /**
     * @var UDateTime|null
     */
    private $dateCreated = null;
    /**
     * @var UDateTime|null
     */
    private $dateUpdated = null;


    /**
     * ColdMachineModel constructor.
     * @param CMMId $id
     * @param CMMName $name
     * @param CMMShortName $shortName
     * @param CMMIdType $idType
     * @param CMMCode $code
     * @param UserId $idUserCreated
     * @param UserId|null $idUserUpdated
     */
    public function __construct(
        CMMId  $id,
        CMMName $name,
        CMMShortName $shortName,
        CMMIdType $idType,
        CMMCode  $code,
        UserId $idUserCreated,
        ?UserId $idUserUpdated
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->shortName = $shortName;
        $this->idType = $idType;
        $this->code = $code;
        $this->idUserCreated = $idUserCreated;
        $this->idUserUpdated = $idUserUpdated;
    }

    /**
     * @return CMMId
     */
    public function getId(): CMMId
    {
        return $this->id;
    }

    /**
     * @return CMMName
     */
    public function getName(): CMMName
    {
        return $this->name;
    }

    /**
     * @return CMMShortName
     */
    public function getShortName(): CMMShortName
    {
        return $this->shortName;
    }

    /**
     * @return CMMIdType
     */
    public function getIdType(): CMMIdType
    {
        return $this->idType;
    }

    /**
     * @return CMMCode
     */
    public function getCode(): CMMCode
    {
        return $this->code;
    }

    /**
     * @return UserId
     */
    public function getIdUserCreated(): UserId
    {
        return $this->idUserCreated;
    }

    /**
     * @return UserId|null
     */
    public function getIdUserUpdated(): ?UserId
    {
        return $this->idUserUpdated;
    }

    /**
     * @return UDateTime|null
     */
    public function getDateCreated(): ?UDateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param UDateTime|null $dateCreated
     */
    public function setDateCreated(?UDateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return UDateTime|null
     */
    public function getDateUpdated(): ?UDateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param UDateTime|null $dateUpdated
     */
    public function setDateUpdated(?UDateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }



    public static function createEntity( $request ): ColdMachineModel
    {
        return new self(
            new CMMId( $request->id ),
            new CMMName( $request->name ),
            new CMMShortName( $request->shortname ),
            new CMMIdType( $request->id_type ),
            new CMMCode( $request->code ),
            new UserId( $request->id_user_created ),
            $request->id_user_updated ? new UserId( $request->id_user_updated ) : null
        );
    }

}
