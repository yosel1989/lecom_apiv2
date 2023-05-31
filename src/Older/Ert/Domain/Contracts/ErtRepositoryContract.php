<?php


namespace Src\Older\Ert\Domain\Contracts;


use Src\Older\Ert\Domain\Ert;
use Src\Older\Ert\Domain\ValueObjects\ErtImei;

interface ErtRepositoryContract
{

    public function findByImei( ErtImei $imei ): ?Ert;

}
