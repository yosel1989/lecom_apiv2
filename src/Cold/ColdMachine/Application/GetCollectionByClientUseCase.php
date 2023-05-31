<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Application;

use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;

final class GetCollectionByClientUseCase
{
    /**
     * @var ColdMachineRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $idClient ): array
    {
        return $this->repository->collectionByClient(new ClientId($idClient));
    }
}
