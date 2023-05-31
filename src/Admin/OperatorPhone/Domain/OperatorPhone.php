<?php

declare(strict_types=1);

namespace Src\Admin\OperatorPhone\Domain;


use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneDeleted;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneName;

final class OperatorPhone
{
    /**
     * @var OperatorPhoneId
     */
    private $id;
    /**
     * @var OperatorPhoneName
     */
    private $name;
    /**
     * @var OperatorPhoneDeleted
     */
    private $deleted;

    /**
     * OperatorPhone constructor.
     * @param OperatorPhoneId $id
     * @param OperatorPhoneName $name
     * @param OperatorPhoneDeleted $deleted
     */
    public function __construct(
        OperatorPhoneId  $id,
        OperatorPhoneName $name,
        OperatorPhoneDeleted $deleted
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->deleted = $deleted;
    }

    /**
     * @return OperatorPhoneId
     */
    public function getId(): OperatorPhoneId
    {
        return $this->id;
    }

    /**
     * @return OperatorPhoneName
     */
    public function getName(): OperatorPhoneName
    {
        return $this->name;
    }

    /**
     * @return OperatorPhoneDeleted
     */
    public function getDeleted(): OperatorPhoneDeleted
    {
        return $this->deleted;
    }


    public static function createEntity( $request ): OperatorPhone
    {
        return new self(
            new OperatorPhoneId ($request->id),
            new OperatorPhoneName($request->name),
            new OperatorPhoneDeleted($request->deleted)
        );
    }

}
