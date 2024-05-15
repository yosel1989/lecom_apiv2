<?php

namespace Src\V2\CronogramaSalida\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\CronogramaSalida\Domain\Contracts\CronogramaSalidaRepositoryContract;

final class DeleteUseCase
{
    /**
     * @var CronogramaSalidaRepositoryContract
     */
    private CronogramaSalidaRepositoryContract $repository;

    public function __construct( CronogramaSalidaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id
    ): void
    {

        $_id = new Id($id,false, 'El id del CronogramaSalida no tiene el formato correcto');

        $this->repository->delete(
            $_id
        );

    }
}
