<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;
use Src\Utility\UDateTime;

final class GetLastByClientCase
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
    ): array
    {
        return $this->repository->lastByClient(
            new ClientId($idClient)
        );
    }
}
