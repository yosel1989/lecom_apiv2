<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlertHistory\Domain\ColdMachineAlertHistory;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;
use Src\Cold\ColdMachineAlertHistory\Domain\ValueObjects\CMAHId;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLatitude;
use Src\Cold\ColdMachineHistory\Domain\ValueObjects\CMHLongitude;
use Src\Utility\UDateTime;

final class CreateUseCase
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
        string $alertId,
        string $machineId,
        string $clientId,
        float $latitude,
        float $longitude,
        string $createdAt
    ): ?ColdMachineAlertHistory
    {
        return $this->repository->create(
            new CMAHId($id),
            new CMAId($alertId),
            new CMId($machineId),
            new ClientId($clientId),
            new CMHLatitude($latitude),
            new CMHLongitude($longitude),
            new UDateTime($createdAt)
        );
    }
}
