<?php

declare(strict_types=1);

namespace Src\V2\TipoDocumento\Application;

use Src\V2\TipoDocumento\Domain\Contracts\TipoDocumentoRepositoryContract;

final class GetListUseCase
{
    private TipoDocumentoRepositoryContract $repository;

    public function __construct(TipoDocumentoRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->list();
    }
}
