<?php

declare(strict_types=1);

namespace Src\Admin\Module\Infrastructure\Repositories;

use App\Models\Admin\Module as EloquentModuleModel;
use Src\Admin\Module\Domain\Contracts\ModuleRepositoryContract;
use Src\Admin\Module\Domain\ValueObjects\ModuleId;
use Src\Admin\Module\Domain\ValueObjects\ModuleName;
use Src\Admin\Module\Domain\Module;
use Src\Admin\Module\Domain\ValueObjects\ModuleShortName;

final class EloquentModuleRepository implements ModuleRepositoryContract
{
    /**
     * @var EloquentModuleModel
     */
    private $EloquentModuleModel;

    public function __construct()
    {
        $this->EloquentModuleModel = new EloquentModuleModel;
    }

    public function find(ModuleId $id): ?Module
    {
        $brand = $this->EloquentModuleModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new Module(
            new ModuleId( $brand->id ),
            new ModuleName( $brand->name ),
            new ModuleShortName( $brand->short_name )
        );

    }

    public function create( ModuleId $id, ModuleName $name, ModuleShortName $shortName ): ?Module
    {
        $module = $this->EloquentModuleModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'short_name'  => $name->value()
        ]);

        return new Module(
            new ModuleId( $module->id ),
            new ModuleName( $module->name ),
            new ModuleShortName( $module->short_name )
        );
    }

    public function update( ModuleId $id, ModuleName $name, ModuleShortName $shortName ): ?Module
    {
        $this->EloquentModuleModel->findOrFail($id->value())->update([
            'name'  => $name->value(),
            'short_name'  => $shortName->value()
        ]);

        $module = $this->EloquentModuleModel->findOrFail($id->value());

        return new Module(
            new ModuleId( $module->id ),
            new ModuleName( $module->name ),
            new ModuleShortName( $module->short_name )
        );
    }

    public function trash( ModuleId $id ): void
    {
        $this->EloquentModuleModel->findOrFail($id->value())->delete();
    }

    public function delete( ModuleId $id ): void
    {
        $this->EloquentModuleModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( ModuleId $id ): void
    {
        $this->EloquentModuleModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $modules = $this->EloquentModuleModel->all();

        $arr = array();

        foreach ( $modules as $module ){
            $arr[] = new Module(
                new ModuleId( $module->id ),
                new ModuleName( $module->name ),
                new ModuleShortName( $module->short_name )
            );
        }

        return $arr;
    }

}
