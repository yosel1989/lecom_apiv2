<?php

declare(strict_types=1);

namespace Src\V2\Cronograma\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Cronograma\Domain\Contracts\CronogramaRepositoryContract;
use Src\V2\Cronograma\Domain\Cronograma;

final class FindPdfByIdUseCase
{
    private CronogramaRepositoryContract $repository;

    public function __construct(CronogramaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idCronograma): Cronograma
    {
        $_idCronograma = new Id($idCronograma,false, 'El id del Cronograma no tiene el formato correcto');
        return $this->repository->findPdf($_idCronograma);
    }
}
