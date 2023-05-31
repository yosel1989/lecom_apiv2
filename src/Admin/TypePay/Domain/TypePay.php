<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Domain;

use Src\Admin\TypePay\Domain\ValueObjects\TypePayAmount;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayCurrency;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDeleted;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDescription;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayId;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayName;

final class TypePay
{
    /**
     * @var TypePayId
     */
    private $id;
    /**
     * @var TypePayName
     */
    private $name;
    /**
     * @var TypePayDescription
     */
    private $description;
    /**
     * @var TypePayCurrency
     */
    private $currency;
    /**
     * @var TypePayDeleted
     */
    private $deleted;
    /**
     * @var TypePayAmount
     */
    private $amount;

    /**
     * TypePay constructor.
     * @param TypePayId $id
     * @param TypePayName $name
     * @param TypePayDescription $description
     * @param TypePayCurrency $currency
     * @param TypePayAmount $amount
     * @param TypePayDeleted $deleted
     */
    public function __construct(
        TypePayId  $id,
        TypePayName $name,
        TypePayDescription $description,
        TypePayCurrency $currency,
        TypePayAmount $amount,
        TypePayDeleted $deleted
    )
    {

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->currency = $currency;
        $this->deleted = $deleted;
        $this->amount = $amount;
    }

    /**
     * @return TypePayId
     */
    public function getId(): TypePayId
    {
        return $this->id;
    }

    /**
     * @return TypePayName
     */
    public function getName(): TypePayName
    {
        return $this->name;
    }

    /**
     * @return TypePayDescription
     */
    public function getDescription(): TypePayDescription
    {
        return $this->description;
    }

    /**
     * @return TypePayCurrency
     */
    public function getCurrency(): TypePayCurrency
    {
        return $this->currency;
    }

    /**
     * @return TypePayDeleted
     */
    public function getDeleted(): TypePayDeleted
    {
        return $this->deleted;
    }

    /**
     * @return TypePayAmount
     */
    public function getAmount(): TypePayAmount
    {
        return $this->amount;
    }


    public static function createEntity( $request ): TypePay
    {
        return new self(
            new TypePayId ($request->id),
            new TypePayName($request->name),
            new TypePayDescription($request->description),
            new TypePayCurrency($request->currency),
            new TypePayAmount($request->amount),
            new TypePayDeleted($request->deleted)
        );
    }

}
