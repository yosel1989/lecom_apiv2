<?php

declare(strict_types=1);

namespace Src\V2\MotivoTraslado\Application;

use Src\V2\MotivoTraslado\Domain\Contracts\MotivoTrasladoRepositoryContract;

final class GetListUseCase
{
    private MotivoTrasladoRepositoryContract $repository;

    public function __construct(MotivoTrasladoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
