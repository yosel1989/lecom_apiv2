<?php

declare(strict_types=1);

namespace Src\Admin\TypePay\Application;

use Src\Admin\TypePay\Domain\Contracts\TypePayRepositoryContract;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayAmount;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayCurrency;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayDescription;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayId;
use Src\Admin\TypePay\Domain\ValueObjects\TypePayName;
use Src\Admin\TypePay\Domain\TypePay;

final class UpdateUseCase
{
    /**
     * @var TypePayRepositoryContract
     */
    private $repository;

    public function __construct(TypePayRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name, ?string $description, int $currency, float $amount ): ?TypePay
    {
        $g_id = new TypePayId($id);
        $g_name = new TypePayName($name);
        $g_description = new TypePayDescription($description);
        $g_currency = new TypePayCurrency($currency);
        $g_amount = new TypePayAmount($amount);
        return $this->repository->update($g_id,$g_name,$g_description,$g_currency,$g_amount);
    }
}
