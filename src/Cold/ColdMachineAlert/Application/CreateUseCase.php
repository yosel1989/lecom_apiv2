<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Application;

use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Domain\Contracts\ColdMachineAlertRepositoryContract;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMACode;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMADescription;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAText;

final class CreateUseCase
{
    /**
     * @var ColdMachineAlertRepositoryContract
     */
    private $repository;

    public function __construct(ColdMachineAlertRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id,
        int $code,
        string $text,
        string $description,
        string $idUserCreated
    ): ?ColdMachineAlert
    {
        return $this->repository->create(
            new CMAId( $id),
            new CMACode( $code ),
            new CMAText( $text ),
            new CMADescription( $description ),
            new UserId($idUserCreated)
        );
    }
}
