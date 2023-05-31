<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachine\Application;

use Src\Cold\ColdMachine\Domain\ColdMachine;
use Src\Cold\ColdMachine\Domain\Contracts\ColdMachineRepositoryContract;
use Src\Cold\ColdMachine\Domain\ValueObjects\CMImei;

final class FindByImeiUseCase
{
    /**
     * @var ColdMachineRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke( string $imei ): ?ColdMachine
    {
        return $this->repository->findByImei(new CMImei($imei));
    }
}
