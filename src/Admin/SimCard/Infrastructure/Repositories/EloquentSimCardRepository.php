<?php

declare(strict_types=1);

namespace Src\Admin\SimCard\Infrastructure\Repositories;

use App\Models\Admin\SimCard as EloquentSimCardModel;
use Src\Admin\Client\Domain\Client;
use Src\Admin\Client\Domain\ValueObjects\ClientId;
use Src\Admin\OperatorPhone\Domain\OperatorPhone;
use Src\Admin\OperatorPhone\Domain\ValueObjects\OperatorPhoneId;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDetail;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardImei;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardNumber;
use Src\Admin\SimCard\Domain\Contracts\SimCardRepositoryContract;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardDeleted;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardId;
use Src\Admin\SimCard\Domain\SimCard;
use Src\Admin\SimCard\Domain\ValueObjects\SimCardStatus;

final class EloquentSimCardRepository implements SimCardRepositoryContract
{
    /**
     * @var EloquentSimCardModel
     */
    private $EloquentSimCardModel;

    public function __construct()
    {
        $this->EloquentSimCardModel = new EloquentSimCardModel;
    }

    public function find(SimCardId $id): ?SimCard
    {
        $simcard = $this->EloquentSimCardModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new SimCard(
            new SimCardId( $simcard->id ),
            new SimCardNumber( $simcard->number ),
            new SimCardImei( $simcard->imei ),
            new SimCardDeleted( $simcard->deleted ),
            new SimCardStatus( $simcard->status ),
            new SimCardDetail( $simcard->detail ),
            new OperatorPhoneId( $simcard->id_telephone_operator ),
            new ClientId( $simcard->id_client )
        );

    }

    public function create( SimCardId $id, SimCardNumber $number, SimCardImei $imei, SimCardDetail $detail, SimCardStatus $status, OperatorPhoneId $idOperator, ClientId $clientId ): ?SimCard
    {
        $this->EloquentSimCardModel->create([
            'id'    => $id->value(),
            'number'  => $number->value(),
            'imei'  => $imei->value(),
            'detail' => $detail->value(),
            'status' => $status->value(),
            'id_telephone_operator' => $idOperator->value(),
            'id_client' => $clientId->value()
        ]);

        $SimCard = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->findOrFail($id->value());

        $OSimCard = new SimCard(
            new SimCardId( $SimCard->id ),
            new SimCardNumber( $SimCard->number ),
            new SimCardImei( $SimCard->imei ),
            new SimCardDeleted( $SimCard->deleted ),
            new SimCardStatus( $SimCard->status ),
            new SimCardDetail( $SimCard->detail ),
            new OperatorPhoneId( $SimCard->id_telephone_operator ),
            new ClientId( $SimCard->id_client )
        );
        $OSimCard->setOperator( $SimCard->idOperator_pk ? OperatorPhone::createEntity($SimCard->idOperator_pk) : null );
        $OSimCard->setClient( $SimCard->idClient_pk ? Client::createEntity($SimCard->idClient_pk) : null );

        return $OSimCard;
    }

    public function update( SimCardId $id, SimCardNumber $number, SimCardImei $imei, SimCardDetail $detail, OperatorPhoneId $idOperator ): ?SimCard
    {
        $this->EloquentSimCardModel->findOrFail($id->value())->update([
            'number'  => $number->value(),
            'imei'  => $imei->value(),
            'detail'  => $detail->value(),
            'id_telephone_operator' => $idOperator->value()
        ]);

        $SimCard = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->findOrFail($id->value());

        $OSimCard = new SimCard(
            new SimCardId( $SimCard->id ),
            new SimCardNumber( $SimCard->number ),
            new SimCardImei( $SimCard->imei ),
            new SimCardDeleted( $SimCard->deleted ),
            new SimCardStatus( $SimCard->status ),
            new SimCardDetail( $SimCard->detail ),
            new OperatorPhoneId( $SimCard->id_telephone_operator ),
            new ClientId( $SimCard->id_client )
        );
        $OSimCard->setOperator( $SimCard->idOperator_pk ? OperatorPhone::createEntity($SimCard->idOperator_pk) : null );
        $OSimCard->setClient( $SimCard->idClient_pk ? Client::createEntity($SimCard->idClient_pk) : null );

        return $OSimCard;
    }

    public function trash( SimCardId $id ): void
    {
        $this->EloquentSimCardModel->findOrFail($id->value())->delete();
    }

    public function delete( SimCardId $id ): void
    {
        $this->EloquentSimCardModel->findOrFail($id->value())->forceDelete();
    }

    public function restore( SimCardId $id ): void
    {
        $this->EloquentSimCardModel->withTrashed()->findOrFail($id->value())->restore();
    }

    public function collection(): array
    {
        $simcards = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->get();

        $collection = array();

        foreach ( $simcards as $simcard ){
            $OSimCard = new SimCard(
                new SimCardId( $simcard->id ),
                new SimCardNumber( $simcard->number ),
                new SimCardImei( $simcard->imei ),
                new SimCardDeleted( $simcard->deleted ),
                new SimCardStatus( $simcard->status ),
                new SimCardDetail( $simcard->detail ),
                new OperatorPhoneId( $simcard->id_telephone_operator ),
                new ClientId( $simcard->id_client )
            );
            $OSimCard->setOperator( $simcard->idOperator_pk ? OperatorPhone::createEntity($simcard->idOperator_pk) : null );
            $OSimCard->setClient( $simcard->idClient_pk ? Client::createEntity($simcard->idClient_pk) : null );
            $collection[] = $OSimCard;
        }

        return $collection;
    }

    public function collectionTrashed(): array
    {
        $simcards = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->onlyTrashed()->get();

        $collection = array();

        foreach ( $simcards as $simcard ){
            $OSimCard = new SimCard(
                new SimCardId( $simcard->id ),
                new SimCardNumber( $simcard->number ),
                new SimCardImei( $simcard->imei ),
                new SimCardDeleted( $simcard->deleted ),
                new SimCardStatus( $simcard->status ),
                new SimCardDetail( $simcard->detail ),
                new OperatorPhoneId( $simcard->id_telephone_operator ),
                new ClientId( $simcard->id_client )
            );
            $OSimCard->setOperator( $simcard->idOperator_pk ? OperatorPhone::createEntity($simcard->idOperator_pk) : null );
            $OSimCard->setClient( $simcard->idClient_pk ? Client::createEntity($simcard->idClient_pk) : null );
            $collection[] = $OSimCard;
        }

        return $collection;
    }

    public function collectionByOperator( OperatorPhoneId $idOperator ): array
    {
        $simcards = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->where('id_telephone_operator', $idOperator->value() )->get();

        $collection = array();

        foreach ( $simcards as $simcard ){
            $OSimCard = new SimCard(
                new SimCardId( $simcard->id ),
                new SimCardNumber( $simcard->number ),
                new SimCardImei( $simcard->imei ),
                new SimCardDeleted( $simcard->deleted ),
                new SimCardStatus( $simcard->status ),
                new SimCardDetail( $simcard->detail ),
                new OperatorPhoneId( $simcard->id_telephone_operator ),
                new ClientId( $simcard->id_client )
            );
            $OSimCard->setOperator( $simcard->idOperator_pk ? OperatorPhone::createEntity($simcard->idOperator_pk) : null );
            $OSimCard->setClient( $simcard->idClient_pk ? Client::createEntity($simcard->idClient_pk) : null );
            $collection[] = $OSimCard;
        }

        return $collection;
    }

    public function collectionByClient( ClientId $clientId ): array
    {
        $simCards = $this->EloquentSimCardModel->with(['idOperator_pk','idClient_pk'])->where('id_client', $clientId->value() )->get();

        $collection = array();

        foreach ( $simCards as $simcard ){
            $OSimCard = new SimCard(
                new SimCardId( $simcard->id ),
                new SimCardNumber( $simcard->number ),
                new SimCardImei( $simcard->imei ),
                new SimCardDeleted( $simcard->deleted ),
                new SimCardStatus( $simcard->status ),
                new SimCardDetail( $simcard->detail ),
                new OperatorPhoneId( $simcard->id_telephone_operator ),
                new ClientId( $simcard->id_client )
            );
            $OSimCard->setOperator( $simcard->idOperator_pk ? OperatorPhone::createEntity($simcard->idOperator_pk) : null );
            $OSimCard->setClient( $simcard->idClient_pk ? Client::createEntity($simcard->idClient_pk) : null );
            $collection[] = $OSimCard;
        }

        return $collection;
    }

    public function collectionTrashedByClient( ClientId $clientId ): array
    {
        $simCards = $this->EloquentSimCardModel->onlyTrashed()->with(['idOperator_pk','idClient_pk'])->where('id_client', $clientId->value() )->get();

        $collection = array();

        foreach ( $simCards as $simcard ){
            $OSimCard = new SimCard(
                new SimCardId( $simcard->id ),
                new SimCardNumber( $simcard->number ),
                new SimCardImei( $simcard->imei ),
                new SimCardDeleted( $simcard->deleted ),
                new SimCardStatus( $simcard->status ),
                new SimCardDetail( $simcard->detail ),
                new OperatorPhoneId( $simcard->id_telephone_operator ),
                new ClientId( $simcard->id_client )
            );
            $OSimCard->setOperator( $simcard->idOperator_pk ? OperatorPhone::createEntity($simcard->idOperator_pk) : null );
            $OSimCard->setClient( $simcard->idClient_pk ? Client::createEntity($simcard->idClient_pk) : null );
            $collection[] = $OSimCard;
        }

        return $collection;
    }

}
