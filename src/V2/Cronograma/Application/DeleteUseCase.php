<?php

namespace Src\V2\Cronograma\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;

final class DeleteUseCase
{
    /**
     * @var CronogramaRepositoryContract
     */
    private CronogramaRepositoryContract $repository;

    public function __construct( CronogramaRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id
    ): void
    {

        $_id = new Id($id,false, 'El id del Cronograma no tiene el formato correcto');

        $this->repository->delete(
            $_id
        );

    }
}
