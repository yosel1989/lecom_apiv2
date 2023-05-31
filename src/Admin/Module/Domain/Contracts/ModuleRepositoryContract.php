<?php

namespace Src\Admin\Module\Domain\Contracts;


use Src\Admin\Module\Domain\ValueObjects\ModuleId;
use Src\Admin\Module\Domain\ValueObjects\ModuleName;
use Src\Admin\Module\Domain\Module;
use Src\Admin\Module\Domain\ValueObjects\ModuleShortName;

interface ModuleRepositoryContract
{
    public function find( ModuleId $id ): ?Module;

    public function create( ModuleId $id, ModuleName $name, ModuleShortName $shortName ): ?Module;

    public function update( ModuleId $id, ModuleName $name, ModuleShortName $shortName ): ?Module;

    public function trash( ModuleId $id ): void;

    public function delete( ModuleId $id ): void;

    public function restore( ModuleId $id ): void;

    public function collection(): array;

}
