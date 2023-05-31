<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDetail;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardImei;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardNumber;
use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardId;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardStatus;

final class CreateUseCase
{
    /**
     * @var SimCardRepositoryContract
     */
    private $repository;

    public function __construct(SimCardRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $number, string $imei, ?string $detail, int $status, ?string $idOperator, string $client ): ?SimCard
    {
        $s_id = new SimCardId($id);
        $s_number = new SimCardNumber($number);
        $s_imei = new SimCardImei($imei);
        $s_detail = new SimCardDetail($detail);
        $s_status = new SimCardStatus($status ? 1 : 0);
        $o_id = new OperatorPhoneId($idOperator);
        $o_client = new ClientId($client);
        return $this->repository->create($s_id,$s_number,$s_imei,$s_detail,$s_status,$o_id,$o_client);
    }
}
