<?php

namespace App\Http\Resources\VehicleTicketing\Ticket;


class TicketsTodayResource
{


    /**
     * @var array
     */
    private $arrTickets;

    private $data = array();

    private $count_total;

    private $price_total;

    private $turn_actual;

    private $tickets_actual;

    private $count_total_actual;

    private $price_total_actual;

    public function __construct( array $arrTickets )
    {
        $this->arrTickets = $arrTickets;
        $this->count_total = count($arrTickets);
        $this->price_total = count($arrTickets) ? array_reduce($arrTickets, function($acumulator,$ticket){ return $acumulator += $ticket['price']['price']; }) : 0;
        $this->turn_actual = count($arrTickets) ? $arrTickets[count($arrTickets)-1]['turn'] : 0;
        $this->tickets_actual = array_values(array_filter( $arrTickets, function($ticket) { return $ticket['turn'] === $this->turn_actual;  }));
        $this->count_total_actual = count($this->tickets_actual);
        $this->price_total_actual = count($this->tickets_actual) ? array_reduce($this->tickets_actual, function($acumulator,$ticket){ return $acumulator += $ticket['price']['price']; }) : 0;
    }

    public function __invoke() : array
    {
        
        //return $this->arrTickets;
        return [
            'data' => array_map(function($ticket){
                $ticket['deleted'] = $ticket['deleted'] ? true : false;
                $ticket['price'] = $ticket['price']['price'];
                return $ticket;
            },$this->tickets_actual),
            'count' => $this->count_total,
            'ptotal' => $this->price_total,
            'turn' => $this->turn_actual,
            'count_turn' => $this->count_total_actual,
            'ptotal_turn' => $this->price_total_actual,
        ];

    }
}
