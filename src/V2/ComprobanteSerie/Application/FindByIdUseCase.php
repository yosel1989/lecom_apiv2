<?php

declare(strict_types=1);

namespace Src\V2\ComprobanteSerie\Application;

use Src\Core\Domain\ValueObjects\Id;
use Src\V2\ComprobanteSerie\Domain\Contracts\ComprobanteSerieRepositoryContract;
use Src\V2\ComprobanteSerie\Domain\ComprobanteSerie;

final class FindByIdUseCase
{
    private ComprobanteSerieRepositoryContract $repository;

    public function __construct(ComprobanteSerieRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): ComprobanteSerie
    {
        $_id = new Id($id,false, 'El id no tiene el formato correcto');
        return $this->repository->find($_id);
    }
}
