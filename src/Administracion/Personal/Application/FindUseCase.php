<?php

namespace Src\Administracion\Personal\Application;

use Src\Administracion\Personal\Domain\Personal;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\Administracion\Personal\Domain\Contracts\PersonalRepositoryContract;

final class FindUseCase
{
    /**
     * @var PersonalRepositoryContract
     */
    private $repository;

    public function __construct( PersonalRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke(
        string $id
    ): Personal
    {
        $id = new Id($id,false,'El id del Personal no tiene el formato valido');

        return $this->repository->find(
            $id
        );

    }
}
