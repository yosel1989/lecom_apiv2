<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Application;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHId;

final class UpdateUseCase
{
    /**
     * @var ColdMachineAlertHistoryRepositoryContract
     */
    private $repository;


    public function __construct(ColdMachineAlertHistoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        string $userId
    ): void
    {
        $this->repository->update(
            new CMAHId($id),
            new UserId($userId)
        );
    }
}
