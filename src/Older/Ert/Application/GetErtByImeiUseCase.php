<?php


namespace Src\Older\Ert\Application;


use Src\Older\Ert\Domain\Contracts\ErtRepositoryContract;
use Src\Older\Ert\Domain\Ert;
use Src\Older\Ert\Domain\ValueObjects\ErtImei;

final class GetErtByImeiUseCase
{
    private $repository;

    public function __construct( ErtRepositoryContract $repository )
    {
        $this->repository = $repository;
    }

    public function __invoke( string $imei ): ?Ert
    {
        $Eimei = new ErtImei($imei);
        return $this->repository->findByImei($Eimei);
    }
}
