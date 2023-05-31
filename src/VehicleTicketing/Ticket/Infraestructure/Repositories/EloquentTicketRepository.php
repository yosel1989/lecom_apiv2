<?php


namespace Src\VehicleTicketing\Ticket\Infraestructure\Repositories;


use App\Models\VehicleTicketing\Ticket as EloquentTicketModel;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Src\Auth\Client\Domain\Client;
use Src\General\Vehicle\Domain\Vehicle;
use Src\ModelBase\Domain\ValueObjects\DateOnlyFormat;
use Src\ModelBase\Domain\ValueObjects\DateTimeFormat;
use Src\ModelBase\Domain\ValueObjects\Id;
use Src\ModelBase\Domain\ValueObjects\Numeric;
use Src\ModelBase\Domain\ValueObjects\Text;
use Src\VehicleTicketing\Ticket\Domain\BoletoLiquidacionDiaria;
use Src\VehicleTicketing\Ticket\Domain\Contracts\TicketRepositoryContract;
use Src\VehicleTicketing\Ticket\Domain\Ticket;
use Src\VehicleTicketing\Ticket\Domain\TicketProduction;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCode;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketCount;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDate;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketDeleted;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketId;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdClient;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdMachine;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdPrice;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdType;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketIdVehicle;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLatitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketLongitude;
use Src\VehicleTicketing\Ticket\Domain\ValueObjects\TicketTurn;
use Src\VehicleTicketing\TicketMachine\Domain\TicketMachine;
use Src\VehicleTicketing\TicketMachine\Domain\ValueObjects\TicketMachineId;
use Src\VehicleTicketing\TicketPrice\Domain\TicketPrice;
use Src\VehicleTicketing\TicketPrice\Domain\ValueObjects\TicketPricePrice;
use Src\VehicleTicketing\TicketType\Domain\TicketType;

final class EloquentTicketRepository implements TicketRepositoryContract
{
    /**
     * @var EloquentTicketModel
     */
    private $eloquentTicketModel;

    public function __construct()
    {
        $this->eloquentTicketModel = new EloquentTicketModel;
    }

    public function find(TicketId $id): ?Ticket
    {
        $ticket = $this->eloquentTicketModel->findOrFail($id->value());
        // Return Domain Ticket model
        return new Ticket(
            new TicketId($ticket->id),
            new TicketCode($ticket->code),
            new TicketDate($ticket->date),
            new TicketLatitude($ticket->latitude),
            new TicketLongitude($ticket->longitude),
            new TicketTurn($ticket->turn),
            new TicketDeleted($ticket->deleted),
            new TicketIdClient($ticket->id_client),
            new TicketIdVehicle($ticket->id_vehicle),
            new TicketIdMachine($ticket->id_ticket_machine),
            new TicketIdPrice($ticket->id_ticket_price),
            new TicketIdType($ticket->id_ticket_type)
        );

    }

    public function findWithRelations( TicketId $id, array $relations ): ?Ticket
    {
        $ticket = $this->eloquentTicketModel
                        ->with($relations)
                        ->findOrFail($id->value());

        // Return Domain Ticket model
        $Ticket = new Ticket(
                    new TicketId($ticket->id),
                    new TicketCode($ticket->code),
                    new TicketDate($ticket->date),
                    new TicketLatitude($ticket->latitude),
                    new TicketLongitude($ticket->longitude),
                    new TicketTurn($ticket->turn),
                    new TicketDeleted($ticket->deleted),
                    new TicketIdClient($ticket->id_client),
                    new TicketIdVehicle($ticket->id_vehicle),
                    new TicketIdMachine($ticket->id_ticket_machine),
                    new TicketIdPrice($ticket->id_ticket_price),
                    new TicketIdType($ticket->id_ticket_type)
                );

        if (in_array('idClient_pk', $relations)){
            $client = is_null($ticket->idClient_pk) ? null: Client::createEntity($ticket->idClient_pk);
            $Ticket->setClient($client);
        }

        if (in_array('idType_pk', $relations)){
            $type = is_null($ticket->idType_pk) ? null: TicketType::createEntity($ticket->idType_pk);
            $Ticket->setType($type);
        }

        if (in_array('idPrice_pk', $relations)){
            $price = is_null($ticket->idPrice_pk) ? null: TicketPrice::createEntity($ticket->idPrice_pk);
            $Ticket->setPrice($price);
        }

        if (in_array('idMachine_pk', $relations)){
            $machine = is_null($ticket->idMachine_pk) ? null: TicketMachine::createEntity($ticket->idMachine_pk);
            $Ticket->setMachine($machine);
        }

        if (in_array('idVehicle_pk', $relations)){
            $vehicle = is_null($ticket->idVehicle_pk) ? null: Vehicle::createEntity($ticket->idVehicle_pk);
            $Ticket->setVehicle($vehicle);
        }

        return $Ticket;
    }

    public function findByCodeDate( TicketCode $code, TicketDate $date , array $relations ): ?Ticket
    {
        $ticket = $this->eloquentTicketModel
            ->with($relations)
            ->where('code',$code->value())
            ->where('date',$date->value())
            ->first();

        if (!$ticket) {
            return null;
        }

        // Return Domain Ticket model
        $Ticket = new Ticket(
            new TicketId($ticket->id),
            new TicketCode($ticket->code),
            new TicketDate($ticket->date),
            new TicketLatitude($ticket->latitude),
            new TicketLongitude($ticket->longitude),
            new TicketTurn($ticket->turn),
            new TicketDeleted($ticket->deleted),
            new TicketIdClient($ticket->id_client),
            new TicketIdVehicle($ticket->id_vehicle),
            new TicketIdMachine($ticket->id_ticket_machine),
            new TicketIdPrice($ticket->id_ticket_price),
            new TicketIdType($ticket->id_ticket_type)
        );

        if (in_array('idClient_pk', $relations)){
            $client = is_null($ticket->idClient_pk) ? null: Client::createEntity($ticket->idClient_pk);
            $Ticket->setClient($client);
        }

        if (in_array('idType_pk', $relations)){
            $type = is_null($ticket->idType_pk) ? null: TicketType::createEntity($ticket->idType_pk);
            $Ticket->setType($type);
        }

        if (in_array('idPrice_pk', $relations)){
            $price = is_null($ticket->idPrice_pk) ? null: TicketPrice::createEntity($ticket->idPrice_pk);
            $Ticket->setPrice($price);
        }

        if (in_array('idMachine_pk', $relations)){
            $machine = is_null($ticket->idMachine_pk) ? null: TicketMachine::createEntity($ticket->idMachine_pk);
            $Ticket->setMachine($machine);
        }

        if (in_array('idVehicle_pk', $relations)){
            $vehicle = is_null($ticket->idVehicle_pk) ? null: Vehicle::createEntity($ticket->idVehicle_pk);
            $Ticket->setVehicle($vehicle);
        }

        return $Ticket;
    }

    public function findLastTicketByTicketMachine( TicketMachineId $idTicketMachine ): ?Ticket
    {

        $today = new \DateTime('now');
        $response = $this->eloquentTicketModel
            ->with('idClient_pk','idVehicle_pk','idPrice_pk','idType_pk')
            ->whereRaw('DATE(date) = ? ',$today->format('Y-m-d'))
            ->where('id_ticket_machine', $idTicketMachine->value())
            ->orderBy('date')
            ->get()
            ->last();

        if ( is_null($response)){
            return null;
        }

        return new Ticket(
            new TicketId($response->id),
            new TicketCode($response->code),
            new TicketDate($response->date),
            new TicketLatitude($response->latitude),
            new TicketLongitude($response->longitude),
            new TicketTurn($response->turn),
            new TicketDeleted($response->deleted),
            new TicketIdClient($response->id_client),
            new TicketIdVehicle($response->id_vehicle),
            new TicketIdMachine($response->id_ticket_machine),
            new TicketIdPrice($response->id_ticket_price),
            new TicketIdType($response->id_ticket_type)
        );
    }

    public function getTicketsTodayByVehicleWithRelations(TicketIdVehicle $ticketIdVehicle, array $relations): array
    {

        $today = new \DateTime('now');

        $response = $this->eloquentTicketModel->with($relations)
            ->whereRaw('DATE(date) = ? ',$today->format('Y-m-d'))
            ->where('id_vehicle', $ticketIdVehicle->value())
            ->orderBy('date')
            ->get();

        $collection = array();

        foreach ( $response as $key => $ticket ){

            $validate = true;
            if( $key===0) {
                $validate = true;
            }
            else{
                //if( $response[$key-1]->code !== $ticket->code && $response[$key-1]->date !== $ticket->date ){
                    $validate = true;
                //}
            }

            //if($validate) {
                $Ticket = Ticket::createEntity($ticket);

                if (in_array('idClient_pk', $relations)) {
                    $client = is_null($ticket->idClient_pk) ? null : Client::createEntity($ticket->idClient_pk);
                    $Ticket->setClient($client);
                }

                if (in_array('idType_pk', $relations)) {
                    $type = is_null($ticket->idType_pk) ? null : TicketType::createEntity($ticket->idType_pk);
                    $Ticket->setType($type);
                }

                if (in_array('idPrice_pk', $relations)) {
                    $price = is_null($ticket->idPrice_pk) ? null : TicketPrice::createEntity($ticket->idPrice_pk);
                    $Ticket->setPrice($price);
                }

                if (in_array('idMachine_pk', $relations)) {
                    $machine = is_null($ticket->idMachine_pk) ? null : TicketMachine::createEntity($ticket->idMachine_pk);
                    $Ticket->setMachine($machine);
                }

                if (in_array('idVehicle_pk', $relations)) {
                    $vehicle = is_null($ticket->idVehicle_pk) ? null : Vehicle::createEntity($ticket->idVehicle_pk);
                    $Ticket->setVehicle($vehicle);
                }

                $collection[] = $Ticket;

            //}
        }

        return $collection;

    }

    public function getTicketsReportByVehicleDateWithRelations( string $start, string $end, TicketIdVehicle $ticketIdVehicle, array $relations): array
    {

        $response = $this->eloquentTicketModel->with($relations)
            ->where('id_vehicle', $ticketIdVehicle->value())
            ->whereDate('date','>=', $start)
            ->whereDate('date','<=', $end)
            ->orderBy('date')
            ->get();

        $collection = array();

        foreach ( $response as $key => $ticket ){

            $validate = false;
            if( $key===0) {
                $validate = true;
            }
            else{
                if( $response[$key-1]->code !== $ticket->code && $response[$key-1]->date !== $ticket->date ){
                    $validate = true;
                }
            }

            //if($validate) {
                $Ticket = Ticket::createEntity($ticket);

                if (in_array('idClient_pk', $relations)) {
                    $client = is_null($ticket->idClient_pk) ? null : Client::createEntity($ticket->idClient_pk);
                    $Ticket->setClient($client);
                }

                if (in_array('idType_pk', $relations)) {
                    $type = is_null($ticket->idType_pk) ? null : TicketType::createEntity($ticket->idType_pk);
                    $Ticket->setType($type);
                }

                if (in_array('idPrice_pk', $relations)) {
                    $price = is_null($ticket->idPrice_pk) ? null : TicketPrice::createEntity($ticket->idPrice_pk);
                    $Ticket->setPrice($price);
                }

                if (in_array('idMachine_pk', $relations)) {
                    $machine = is_null($ticket->idMachine_pk) ? null : TicketMachine::createEntity($ticket->idMachine_pk);
                    $Ticket->setMachine($machine);
                }

                if (in_array('idVehicle_pk', $relations)) {
                    $vehicle = is_null($ticket->idVehicle_pk) ? null : Vehicle::createEntity($ticket->idVehicle_pk);
                    $Ticket->setVehicle($vehicle);
                }

                $collection[] = $Ticket;

            //}
        }

        return $collection;

    }

    /**
     * @param string $start
     * @param string $end
     * @param array $listIdVehicle
     * @param array $relations
     * @return array
     */
    public function getTicketCollectionByUserOfDateWithRelations( string $start, string $end, array $listIdVehicle , array $relations): array
    {
        $response = $this->eloquentTicketModel->with($relations)
            ->whereDate('date','>=', $start)
            ->whereDate('date','<=', $end)
            ->whereIn('id_vehicle', $listIdVehicle)
            ->orderBy('date')
            ->get();

        $collection = array();

        foreach ( $response as $key => $ticket ){

            $validate = false;
            if( $key===0) {
                $validate = true;
            }
            else{
                if( $response[$key-1]->code !== $ticket->code && $response[$key-1]->date !== $ticket->date ){
                    $validate = true;
                }
            }

            //if($validate) {
            $Ticket = Ticket::createEntity($ticket);

            if (in_array('idClient_pk', $relations)) {
                $client = is_null($ticket->idClient_pk) ? null : Client::createEntity($ticket->idClient_pk);
                $Ticket->setClient($client);
            }

            if (in_array('idType_pk', $relations)) {
                $type = is_null($ticket->idType_pk) ? null : TicketType::createEntity($ticket->idType_pk);
                $Ticket->setType($type);
            }

            if (in_array('idPrice_pk', $relations)) {
                $price = is_null($ticket->idPrice_pk) ? null : TicketPrice::createEntity($ticket->idPrice_pk);
                $Ticket->setPrice($price);
            }

            if (in_array('idMachine_pk', $relations)) {
                $machine = is_null($ticket->idMachine_pk) ? null : TicketMachine::createEntity($ticket->idMachine_pk);
                $Ticket->setMachine($machine);
            }

            if (in_array('idVehicle_pk', $relations)) {
                $vehicle = is_null($ticket->idVehicle_pk) ? null : Vehicle::createEntity($ticket->idVehicle_pk);
                $Ticket->setVehicle($vehicle);
            }

            $collection[] = $Ticket;

            //}
        }

        return $collection;
    }


    /**
     * @param string $start
     * @param string $end
     * @param array $fleetVehicle
     * @param array $relations
     * @return array
     */
    public function getTicketProductionByDateOfFleetWithRelations( string $start , string $end, array $fleetVehicle , array $relations ): array
    {

        $collection = array();
        $response = $this->eloquentTicketModel->with($relations)
            ->select(
            'btj_tickets.*'
            )
            ->selectRaw("SUM(btj_ticket_prices.price) as price")
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("DATE(date) as dateT")
            ->join('btj_ticket_prices','btj_tickets.id_ticket_price','=','btj_ticket_prices.id')
            ->whereDate('date','>=', $start)
            ->whereDate('date','<=', $end)
            ->whereIn('id_vehicle', $fleetVehicle)
            ->groupBy("id_vehicle")
            ->groupBy("turn")
            ->groupBy("dateT")
            ->get();

        foreach( $response as $production ){
            $ticketProduction = new TicketProduction(
                new TicketDate( $production->dateT . " 00:00:00"),
                new TicketTurn( $production->turn ),
                new TicketIdClient( $production->id_client),
                new TicketIdVehicle( $production->id_vehicle ),
                new TicketPricePrice( $production->price ),
                new TicketCount( $production->total )
            );

            if (in_array('idClient_pk', $relations)) {
                $client = is_null($production->idClient_pk) ? null : Client::createEntity($production->idClient_pk);
                $ticketProduction->setClient($client);
            }

            if (in_array('idVehicle_pk', $relations)) {
                $vehicle = is_null($production->idVehicle_pk) ? null : Vehicle::createEntity($production->idVehicle_pk);
                $ticketProduction->setVehicle($vehicle);
            }

            $collection[] = $ticketProduction;
        }

        return $collection;
    }


    /**
     * @param Ticket $ticket
     */
    public function save( Ticket $ticket ): void
    {

        $newTicket = $this->eloquentTicketModel;

        $data = [
            'id' => $ticket->getId()->value(),
            'code' => $ticket->getCode()->value(),
            'date' => $ticket->getDate()->value(),
            'latitude' => $ticket->getLatitude()->value(),
            'longitude' => $ticket->getLongitude()->value(),
            'turn' => $ticket->getTurn()->value(),
            'deleted' => $ticket->getDeleted()->value(),
            'id_client' => $ticket->getIdClient()->value(),
            'id_vehicle' => $ticket->getIdVehicle()->value(),
            'id_ticket_machine' => $ticket->getIdMachine()->value(),
            'id_ticket_price' => $ticket->getIdPrice()->value(),
            'id_ticket_type' => $ticket->getIdType()->value(),
        ];

        $newTicket->create( $data );

    }


    /**
     * @param string $start
     * @param string $end
     * @param array $fleetVehicle
     * @param array $relations
     * @return array
     */
    public function getTicketProductionRanckingOfFleetByDateWithRelations(string $start , string $end, array $fleetVehicle , array $relations ): array
    {

        $collection = array();
        $response = $this->eloquentTicketModel->with($relations)
            ->select(
                'btj_tickets.*',
            )
            ->selectRaw('SUM(btj_ticket_prices.price) as price')
            ->selectRaw('COUNT(*) as total')
            ->join('btj_ticket_prices','btj_tickets.id_ticket_price','=','btj_ticket_prices.id')
            ->whereDate('date','>=', $start)
            ->whereDate('date','<=', $end)
            ->whereIn('id_vehicle', $fleetVehicle)
            ->groupBy('id_vehicle')
            ->orderBy('price')
            ->get();

        foreach( $response as $production ){
            $ticketProduction = new TicketProduction(
                new TicketDate( $production->date ),
                new TicketTurn( $production->turn ),
                new TicketIdClient( $production->id_client ),
                new TicketIdVehicle( $production->id_vehicle ),
                new TicketPricePrice( $production->price ),
                new TicketCount( $production->total ),
            );

            if (in_array('idClient_pk', $relations)) {
                $client = is_null($production->idClient_pk) ? null : Client::createEntity($production->idClient_pk);
                $ticketProduction->setClient($client);
            }

            if (in_array('idVehicle_pk', $relations)) {
                $vehicle = is_null($production->idVehicle_pk) ? null : Vehicle::createEntity($production->idVehicle_pk);
                $ticketProduction->setVehicle($vehicle);
            }

            $collection[] = $ticketProduction;
        }

        return $collection;
    }


    /**
     * @param string $start
     * @param string $end
     * @param array $fleetVehicle
     * @param array $relations
     * @return array
     */
    public function getTicketProductionRanckingOfFleetByDateByTicketTypeWithRelations( string $start , string $end, array $fleetVehicle , array $relations ): array
    {

        $collection = array();
        $response = $this->eloquentTicketModel->with($relations)
            ->select(
                'btj_tickets.*'
            )
            ->selectRaw('SUM(btj_ticket_prices.price) as price')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("DATE(date) as dateT")
            ->join('btj_ticket_prices','btj_tickets.id_ticket_price','=','btj_ticket_prices.id')
            ->whereDate('date','>=', $start)
            ->whereDate('date','<=', $end)
            ->whereIn('id_vehicle', $fleetVehicle)
            ->groupBy('id_vehicle')
            ->groupBy('id_ticket_type')
            ->groupBy('dateT')
            ->get();

        foreach( $response as $production ){
            $ticketProduction = new TicketProduction(
                new TicketDate( $production->date ),
                new TicketTurn( $production->turn ),
                new TicketIdClient( $production->id_client ),
                new TicketIdVehicle( $production->id_vehicle ),
                new TicketPricePrice( $production->price ),
                new TicketCount( $production->total ),
            );

            if (in_array('idClient_pk', $relations)) {
                $client = is_null($production->idClient_pk) ? null : Client::createEntity($production->idClient_pk);
                $ticketProduction->setClient($client);
            }

            if (in_array('idVehicle_pk', $relations)) {
                $vehicle = is_null($production->idVehicle_pk) ? null : Vehicle::createEntity($production->idVehicle_pk);
                $ticketProduction->setVehicle($vehicle);
            }

            if (in_array('idType_pk', $relations)) {
                $type = is_null($production->idType_pk) ? null : TicketType::createEntity($production->idType_pk);
                $ticketProduction->setType($type);
            }

            $collection[] = $ticketProduction;
        }

        return $collection;
    }

    function getTurnActualByIdVehicle( TicketIdVehicle $ticketIdVehicle ): ?int
    {
        $today = new \DateTime('now');

        $turn = $this->eloquentTicketModel
            ->selectRaw('MAX(turn) as turn')
            ->whereRaw('DATE(date) = ? ', $today->format('Y-m-d'))
            ->where('id_vehicle',$ticketIdVehicle->value())
            ->first();

        if (!$turn) {
            return null;
        }

        return $turn->turn;
    }


    public function getTicketsCollectionByDateByVehicleByTurnWithRelations( string $date, TicketIdVehicle $ticketIdVehicle, TicketTurn $ticketTurn, array $relations): array
    {

        $response = $this->eloquentTicketModel->with($relations)
            ->whereRaw('DATE(date) = ? ',$date)
            ->where('id_vehicle', $ticketIdVehicle->value())
            ->where('turn', $ticketTurn->value())
            ->orderBy('date')
            ->get();

        $collection = array();

        foreach ( $response as $key => $ticket ){

            $validate = false;
            if( $key===0) {
                $validate = true;
            }
            else{
                if( $response[$key-1]->code !== $ticket->code && $response[$key-1]->date !== $ticket->date ){
                    $validate = true;
                }
            }

            //if($validate) {
            $Ticket = Ticket::createEntity($ticket);

            if (in_array('idClient_pk', $relations)) {
                $client = is_null($ticket->idClient_pk) ? null : Client::createEntity($ticket->idClient_pk);
                $Ticket->setClient($client);
            }

            if (in_array('idType_pk', $relations)) {
                $type = is_null($ticket->idType_pk) ? null : TicketType::createEntity($ticket->idType_pk);
                $Ticket->setType($type);
            }

            if (in_array('idPrice_pk', $relations)) {
                $price = is_null($ticket->idPrice_pk) ? null : TicketPrice::createEntity($ticket->idPrice_pk);
                $Ticket->setPrice($price);
            }

            if (in_array('idMachine_pk', $relations)) {
                $machine = is_null($ticket->idMachine_pk) ? null : TicketMachine::createEntity($ticket->idMachine_pk);
                $Ticket->setMachine($machine);
            }

            if (in_array('idVehicle_pk', $relations)) {
                $vehicle = is_null($ticket->idVehicle_pk) ? null : Vehicle::createEntity($ticket->idVehicle_pk);
                $Ticket->setVehicle($vehicle);
            }

            $collection[] = $Ticket;

            //}
        }

        return $collection;

    }

    // Version 1
    public function registrarBoletoPorPlaca(
        Id $idBoleto,
        Id $idVehiculo,
        Id $idRuta,
        Numeric $latitud,
        Numeric $longitud,
        DateTimeFormat $fecha,
        Numeric $monto,
        Text $numeroBoleto,
        Text $dni,
        DateOnlyFormat $reserved
    ): void
    {
        $_f = new \DateTime($fecha->value());


        $query = "call Boletaje_RegistrarBoletoPorPlaca('" . $idBoleto->value() . "', '" . $idVehiculo->value() ."', '" . $idRuta->value() . "', ". $latitud->value() .", " . $longitud->value() .", '" . $_f->format('Y-m-d H:m:s') . "', " . $monto->value() .", '" . $numeroBoleto->value() ."', '" . $dni->value() ."', '". $reserved->value() ."')";
        $data = DB::select($query);

        $codeError = 0;
        $hasError = false;
        $messageError = '';

        foreach ( $data as $item ){

            $hasError = (bool)$item->TieneError;
            $codeError = (int)$item->Codigo;
            $messageError = $item->Mensaje;

        }

        if($hasError){
            throw new Exception($messageError, $codeError);
        }

    }

    public function liquidacionDiariaBus(DateOnlyFormat $fecha, Id $idCliente, Id $idVehiculo): array
    {
        $collection = [];

        $response = DB::select('call Adm_Interprov_BoletoLiquidacionDiariaBus(?,?,?)',array($idCliente->value(),$fecha->value(),$idVehiculo->value()));

        foreach( $response as $item) {
            $model = new BoletoLiquidacionDiaria(
                new Id($item->IdRuta,false,'El id del tipo de egreso no tiene el formato valido'),
                new Text($item->Ruta,true, 75,'El texto de la liquidación los 75 caracteres'),
                new Numeric($item->NumeroBoletos,false),
                new Numeric((float)$item->Precio,false),
                new Numeric((float)$item->Total,false),
            );
            $collection[] = $model;
        }

        return $collection;
    }

}
