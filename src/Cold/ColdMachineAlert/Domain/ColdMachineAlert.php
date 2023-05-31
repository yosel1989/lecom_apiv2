<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Domain;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMACode;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMADescription;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAText;
use Src\Utility\UDateTime;

final class ColdMachineAlert
{

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
     * @var CMAId
     */
    private $id;
    /**
     * @var CMACode
     */
    private $code;
    /**
     * @var CMAText
     */
    private $text;
    /**
     * @var CMADescription
     */
    private $description;


    /**
     * ColdMachineAlert constructor.
     * @param CMAId $id
     * @param CMACode $code
     * @param CMAText $text
     * @param CMADescription $description
     * @param UserId $idUserCreated
     * @param UserId|null $idUserUpdated
     */
    public function __construct(
        CMAId  $id,
        CMACode $code,
        CMAText $text,
        CMADescription $description,
        UserId $idUserCreated,
        ?UserId $idUserUpdated
    )
    {

        $this->id = $id;
        $this->code = $code;
        $this->text = $text;
        $this->description = $description;
        $this->idUserCreated = $idUserCreated;
        $this->idUserUpdated = $idUserUpdated;
    }

    /**
     * @return CMAId
     */
    public function getId(): CMAId
    {
        return $this->id;
    }

    /**
     * @return CMACode
     */
    public function getCode(): CMACode
    {
        return $this->code;
    }

    /**
     * @return CMAText
     */
    public function getText(): CMAText
    {
        return $this->text;
    }

    /**
     * @return CMADescription
     */
    public function getDescription(): CMADescription
    {
        return $this->description;
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



    public static function createEntity( $request): ColdMachineAlert
    {

        return new self(
            new CMAId( $request->id),
            new CMACode( $request->code ),
            new CMAText( $request->text ),
            new CMADescription( $request->description ),
            new UserId( $request->id_user_created ),
            $request->id_user_updated ? new UserId( $request->id_user_updated ) : null
        );
    }

}
