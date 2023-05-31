<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;

final class CountByClientCase
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
        string $idClient
    ): int
    {
        return $this->repository->countByClient(
            new ClientId($idClient)
        );
    }
}
