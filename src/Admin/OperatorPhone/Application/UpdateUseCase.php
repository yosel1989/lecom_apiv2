<?php

declare(strict_types=1);

namespace Src\Admin\OperatorPhone\Application;

use Src\Admin\OperatorPhone\Domain\Contracts\OperatorPhoneRepositoryContract;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneName;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;

final class UpdateUseCase
{
    /**
     * @var OperatorPhoneRepositoryContract
     */
    private $repository;

    public function __construct(OperatorPhoneRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $id, string $name ): ?OperatorPhone
    {
        $o_id = new OperatorPhoneId($id);
        $o_name = new OperatorPhoneName($name);
        return $this->repository->update($o_id,$o_name);
    }
}
