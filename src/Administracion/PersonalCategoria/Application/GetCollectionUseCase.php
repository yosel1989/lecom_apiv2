<?php


namespace Src\Administracion\PersonalCategoria\Application;

use Src\Administracion\PersonalCategoria\Domain\Contracts\PersonalCategoriaRepositoryContract;

final class GetCollectionUseCase
{
    private $repository;

    public function __construct(PersonalCategoriaRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->collection(9);
    }

}
