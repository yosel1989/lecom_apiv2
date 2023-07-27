<?php

declare(strict_types=1);

namespace Src\V2\Serie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\Serie\Domain\Contracts\SerieRepositoryContract;
use Src\V2\Serie\Domain\Serie;

final class FindByIdUseCase
{
    private SerieRepositoryContract $repository;

    public function __construct(SerieRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $idSerie): Serie
    {
        $_idSerie = new Id($idSerie,false, 'El id del Serie no tiene el formato correcto');
        return $this->repository->find($_idSerie);
    }
}
