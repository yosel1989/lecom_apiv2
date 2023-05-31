<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineModel\Infrastructure\Repositories;

use App\Models\Cold\ColdMachineModel as EloquentColdMachineModelModel;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMCode;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMId;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMIdType;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMName;
use Src\Cold\ColdMachineModel\Domain\ValueObjects\CMMShortName;
use Src\Cold\ColdMachineModel\Domain\Contracts\ColdMachineModelRepositoryContract;
use Src\Cold\ColdMachineModel\Domain\ColdMachineModel;
use Src\Utility\UDateTime;

final class EloquentColdMachineModelRepository implements ColdMachineModelRepositoryContract
{
    /**
     * @var EloquentColdMachineModelModel
     */
    private $EloquentColdMachineModelModel;

    public function __construct()
    {
        $this->EloquentColdMachineModelModel = new EloquentColdMachineModelModel;
    }

    public function find( CMMId $id ): ?ColdMachineModel
    {
        $response = $this->EloquentColdMachineModelModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachineModel = new ColdMachineModel(
            new CMMId( $response->id ),
            new CMMName( $response->name ),
            new CMMShortName( $response->shortname ),
            new CMMIdType( $response->id_type ),
            new CMMCode($response->code),
            new UserId($response->id_user_created),
            $response->id_user_updated ? new UserId($response->id_user_updated) : null
        );
        $OColdMachineModel->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineModel->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineModel;
    }

    public function create(
        CMMId $id,
        CMMName $name,
        CMMShortName $shortName,
        CMMIdType $idType,
        CMMCode $code,
        UserId $idUserCreated
    ): ?ColdMachineModel{
        $date = new \DateTime('now');
        $this->EloquentColdMachineModelModel->create([
            'id'    => $id->value(),
            'name'  => $name->value(),
            'shortname'  => $shortName->value(),
            'id_type' => $idType->value(),
            'code' => $code->value(),
            'id_user_created' => $idUserCreated->value(),
            'created_at' => $date->format('Y-m-d H:i:s')
        ]);
        $response = $this->EloquentColdMachineModelModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachineModel =  new ColdMachineModel(
            new CMMId( $response->id ),
            new CMMName( $response->name ),
            new CMMShortName( $response->shortname ),
            new CMMIdType( $response->id_type ),
            new CMMCode($response->code),
            new UserId($response->id_user_created),
            $response->id_user_updated ? new UserId($response->id_user_updated) : null
        );
        $OColdMachineModel->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineModel->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineModel;
    }

    public function update(
        CMMId $id,
        CMMName $name,
        CMMShortName $shortName,
        CMMIdType $idType,
        CMMCode $code,
        UserId $idUserUpdated
    ): ?ColdMachineModel
    {
        $date = new \DateTime('now');
        $this->EloquentColdMachineModelModel->findOrFail($id->value())->update([
            'name' => $name->value(),
            'shortname' => $shortName->value(),
            'id_type' => $idType->value(),
            'code' => $code->value(),
            'id_user_updated' => $idUserUpdated->value()
        ]);
        $response = $this->EloquentColdMachineModelModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachineModel = new ColdMachineModel(
            new CMMId($response->id),
            new CMMName($response->name),
            new CMMShortName($response->shortname),
            new CMMIdType($response->id_type),
            new CMMCode($response->code),
            new UserId($response->id_user_created),
            $response->id_user_updated ? new UserId($response->id_user_updated) : null
        );
        $OColdMachineModel->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineModel->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineModel;
    }

    public function trash( CMMId $id ): void
    {
        $this->EloquentColdMachineModelModel->findOrFail($id->value())->delete();
    }

    public function delete( CMMId $id ): void
    {
        $this->EloquentColdMachineModelModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( CMMId $id ): void
    {
        $this->EloquentColdMachineModelModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $responseArray = $this->EloquentColdMachineModelModel->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineModel = new ColdMachineModel(
                new CMMId( $response->id ),
                new CMMName( $response->name ),
                new CMMShortName( $response->shortname ),
                new CMMIdType( $response->id_type ),
                new CMMCode($response->code),
                new UserId($response->id_user_created),
                $response->id_user_updated ? new UserId($response->id_user_updated) : null
            );
            $OColdMachineModel->setDateCreated( new UDateTime($response->created_at));
            $OColdMachineModel->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $collection[] = $OColdMachineModel;
        }

        return $collection;
    }

    public function collectionTrashed(): array
    {
        $responseArray = $this->EloquentColdMachineModelModel->onlyTrashed()->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineModel = new ColdMachineModel(
                new CMMId( $response->id ),
                new CMMName( $response->name ),
                new CMMShortName( $response->shortname ),
                new CMMIdType( $response->id_type ),
                new CMMCode($response->code),
                new UserId($response->id_user_created),
                $response->id_user_updated ? new UserId($response->id_user_updated) : null
            );
            $OColdMachineModel->setDateCreated( new UDateTime($response->created_at));
            $OColdMachineModel->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $collection[] = $OColdMachineModel;
        }

        return $collection;
    }

}
