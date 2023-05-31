<?php

declare(strict_types=1);

namespace Src\Cold\ColdMachineAlert\Infrastructure\Repositories;

use App\Models\Cold\ColdMachineAlert as EloquentColdMachineAlertModel;
use Src\Admin\User\Domain\ValueObjects\UserId;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMACode;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMADescription;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAId;
use Src\Cold\ColdMachineAlert\Domain\Contracts\ColdMachineAlertRepositoryContract;
use Src\Cold\ColdMachineAlert\Domain\ColdMachineAlert;
use Src\Cold\ColdMachineAlert\Domain\ValueObjects\CMAText;
use Src\Utility\UDateTime;

final class EloquentColdMachineAlertRepository implements ColdMachineAlertRepositoryContract
{
    /**
     * @var EloquentColdMachineAlertModel
     */
    private $EloquentColdMachineAlertModel;

    public function __construct()
    {
        $this->EloquentColdMachineAlertModel = new EloquentColdMachineAlertModel;
    }

    public function findByCode( CMACode $code ): ?ColdMachineAlert
    {
        $response = $this->EloquentColdMachineAlertModel->where('code',$code->value())->first();

        if(!$response){
            return null;
        }

        // Return Domain Ticket model
        $OColdMachineAlert = new ColdMachineAlert(
            new CMAId( $response->id),
            new CMACode( $response->code ),
            new CMAText( $response->text ),
            new CMADescription( $response->description ),
            new UserId( $response->id_user_created ),
            $response->id_user_updated ? new UserId( $response->id_user_updated ) : null
        );
        $OColdMachineAlert->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineAlert->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineAlert;
    }

    public function create(
        CMAId  $id,
        CMACode $code,
        CMAText $text,
        CMADescription $description,
        UserId $idUserCreated
    ): ?ColdMachineAlert{
        $date = new \DateTime('now');
        $this->EloquentColdMachineAlertModel->create([
            'id'    => $id->value(),
            'code'  => $code->value(),
            'text'  => $text->value(),
            'description' => $description->value(),
            'id_user_created' => $idUserCreated->value(),
            'created_at' => $date->format('Y-m-d H:i:s')
        ]);
        $response = $this->EloquentColdMachineAlertModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachineAlert =  new ColdMachineAlert(
            new CMAId( $response->id),
            new CMACode( $response->code ),
            new CMAText( $response->text ),
            new CMADescription( $response->description ),
            new UserId( $response->id_user_created ),
            $response->id_user_updated ? new UserId( $response->id_user_updated ) : null
        );
        $OColdMachineAlert->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineAlert->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineAlert;
    }

    public function update(
        CMAId  $id,
        CMACode $code,
        CMAText $text,
        CMADescription $description,
        UserId $idUserUpdated
    ): ?ColdMachineAlert
    {
        $date = new \DateTime('now');
        $this->EloquentColdMachineAlertModel->findOrFail($id->value())->update([
            'id'    => $id->value(),
            'code'  => $code->value(),
            'text'  => $text->value(),
            'description' => $description->value(),
            'id_user_updated' => $idUserUpdated->value(),
            'updated_at' => $date->format('Y-m-d H:i:s')
        ]);
        $response = $this->EloquentColdMachineAlertModel->findOrFail($id->value());
        // Return Domain Ticket model
        $OColdMachineAlert = new ColdMachineAlert(
            new CMAId( $response->id),
            new CMACode( $response->code ),
            new CMAText( $response->text ),
            new CMADescription( $response->description ),
            new UserId( $response->id_user_created ),
            $response->id_user_updated ? new UserId( $response->id_user_updated ) : null
        );
        $OColdMachineAlert->setDateCreated( new UDateTime($response->created_at));
        $OColdMachineAlert->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
        return $OColdMachineAlert;
    }

    public function trash( CMAId $id ): void
    {
        $this->EloquentColdMachineAlertModel->findOrFail($id->value())->delete();
    }

    public function delete( CMAId $id ): void
    {
        $this->EloquentColdMachineAlertModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( CMAId $id ): void
    {
        $this->EloquentColdMachineAlertModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $responseArray = $this->EloquentColdMachineAlertModel->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineAlert = new ColdMachineAlert(
                new CMAId( $response->id),
                new CMACode( $response->code ),
                new CMAText( $response->text ),
                new CMADescription( $response->description ),
                new UserId( $response->id_user_created ),
                $response->id_user_updated ? new UserId( $response->id_user_updated ) : null
            );
            $OColdMachineAlert->setDateCreated( new UDateTime($response->created_at));
            $OColdMachineAlert->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $collection[] = $OColdMachineAlert;
        }

        return $collection;
    }

    public function collectionTrashed(): array
    {
        $responseArray = $this->EloquentColdMachineAlertModel->onlyTrashed()->all();
        $collection = array();

        foreach ( $responseArray as $response ){
            $OColdMachineAlert = new ColdMachineAlert(
                new CMAId( $response->id),
                new CMACode( $response->code ),
                new CMAText( $response->text ),
                new CMADescription( $response->description ),
                new UserId( $response->id_user_created ),
                $response->id_user_updated ? new UserId( $response->id_user_updated ) : null
            );
            $OColdMachineAlert->setDateCreated( new UDateTime($response->created_at));
            $OColdMachineAlert->setDateUpdated( $response->updated_at ? new UDateTime($response->updated_at) : null);
            $collection[] = $OColdMachineAlert;
        }

        return $collection;
    }

}
