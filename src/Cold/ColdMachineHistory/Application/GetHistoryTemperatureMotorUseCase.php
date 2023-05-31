<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineHistory\Application;

use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;
use Src\Cold\ColdMachineHistory\Domain\Contracts\ColdMachineHistoryRepositoryContract;
use Src\Utility\UDateTime;

final class GetHistoryTemperatureMotorUseCase
{

    /**
     * @var ColdMachineHistoryRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineHistoryRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $dateStart,
        string $dateEnd,
        string $imei
    ): array
    {
        return $this->repository->historyLevelOutput(
            new UDateTime($dateStart." 00:00:00"),
            new UDateTime($dateEnd." 00:00:00"),
            new CMImei($imei)
        );
    }

}
