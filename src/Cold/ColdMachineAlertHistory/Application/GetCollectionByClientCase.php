<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlertHistory\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachineAlertHistory\Domain\Contracts\ColdMachineAlertHistoryRepositoryContract;
use Src\Utility\UDateTime;

final class GetCollectionByClientCase
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
        string $idClient,
        string $dateStart,
        string $dateEnd
    ): array
    {
        return $this->repository->collectionByClient(
            new ClientId($idClient),
            new UDateTime($dateStart . ' 00:00:00'),
            new UDateTime($dateEnd . ' 00:00:00')
        );
    }
}
